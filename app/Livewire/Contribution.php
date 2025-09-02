<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use App\Models\UserTransaction;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\GroupSettings;

class Contribution extends Component
{
    public $manual_amount; // Manual user-entered amount
    public $transaction_type = 'RD'; // Default selected
    public $group_id;
    public $groups = [];
    public $confirmedMismatch = false;
    public $showWarning = false; // Add this property

    public function mount()
    {
         $this->groups = $this->getGroupsForCurrentUser();

    if (!$this->group_id && count($this->groups) > 0) {
        $this->group_id = $this->groups[0]['group_id'];
    }

    if (count($this->groups) === 0) {
        session()->flash('payment-error', "You are not in any group currently.");
    }
    }

    private function getGroupsForCurrentUser()
    {
        $userId = Session::get('user_id');
        $user = User::with('groups')->where('user_id', $userId)->first();

        if (!$user) return [];

        return $user->groups->map(function ($group) {
            return [
                'group_id' => $group->group_id,
                'group_name' => $group->group_name,
                'village' => $group->village,
                'district' => $group->district,
                'state' => $group->state,
            ];
        })->toArray();
    }

    public function updatedGroupId()
    {
        $this->confirmedMismatch = false;
        $this->showWarning = false; // Reset warning when group changes
    }

    public function updatedManualAmount()
    {
        $this->confirmedMismatch = false;
        $this->showWarning = false; // Reset warning when amount changes
    }

    public function confirmMismatch()
    {
        $this->confirmedMismatch = true;
        $this->showWarning = false;
        $this->makePayment();
    }

    public function makePayment()
    {
        // Validation
        if (!$this->manual_amount || !$this->group_id) {
            session()->flash('payment-error', 'Please select a group and enter an amount.');
            return;
        }

        if ($this->manual_amount < 0) {
            session()->flash('payment-error', 'Please enter a valid amount greater than 1.');
            return;
        }

        // Only allow one RD/FD transaction per day per user per group
    if (in_array($this->transaction_type, ['RD', 'FD'])) {
        $UserId = session('user_id');
        $today = now()->toDateString();
        $exists = UserTransaction::where('user_id', $UserId)
            ->where('group_id', $this->group_id)
            ->where('transaction_type', $this->transaction_type)
            ->whereDate('created_at', $today)
            ->exists();

        if ($exists) {
            session()->flash('payment-error', 'Only one ' . $this->transaction_type . ' transaction is allowed per day.');
            return;
        }
    }

        // Check for amount mismatch only if not already confirmed
        if (!$this->confirmedMismatch) {
            $groupSetting = GroupSettings::where('group_id', $this->group_id)->first();
            $expectedAmount = $groupSetting ? $groupSetting->monthly_contribution : null;

            if ($expectedAmount && $this->manual_amount != $expectedAmount) {
                $this->showWarning = true;
                session()->flash('payment-warning', "Entered amount ₹{$this->manual_amount} doesn't match the expected ₹{$expectedAmount}. Do you still want to proceed?");
                return;
            }
        }

        $UserId = session('user_id');
        $user = User::where('user_id', $UserId)->first();

        if (!$user) {
            session()->flash('payment-error', 'User not found. Please log in again.');
            return;
        }

        try {
            $transactionId = 'pending_' . Str::uuid()->toString();
            $paymentId = $this->generatePaymentId($user->user_id);

            UserTransaction::create([
                'payment_id' => $paymentId,
                'transaction_id' => $transactionId,
                'user_id' => $user->user_id,
                'group_id' => $this->group_id,
                'amount' => $this->manual_amount,
                'transaction_type' => $this->transaction_type,
            ]);

            session()->flash('payment-success', 'Payment initiated. Waiting for confirmation!');
            
            // Reset form
            $this->confirmedMismatch = false;
            $this->showWarning = false;
            $this->manual_amount = '';
            
        } catch (\Exception $e) {
            \Log::error('Payment failed: ' . $e->getMessage());
            session()->flash('payment-error', 'An error occurred: ' . $e->getMessage());
        }
    }

    private function generatePaymentId($userId)
    {
        $prefix = 'PAYMENT';
        $userId = strtoupper($userId);
        $groupId = strtoupper($this->group_id);
        $user_GroupId = $userId . '_' . $groupId . '_';
        $date = date('dmY');

        do {
            $random = str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
            $transactionId = $prefix . $user_GroupId . $date . $random;
        } while (UserTransaction::where('transaction_id', $transactionId)->exists());

        return $transactionId;
    }

    public function render()
    {
        return view('livewire.contribution');
    }
}
