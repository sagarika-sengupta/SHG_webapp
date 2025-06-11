<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTransaction;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str; //used for generating uuid

class Contribution extends Component
{
    public $user_id;
    public $amount=[200, 500, 1000];
    public $transaction_type=['RD','FD'];
    public $transactionId='pending'; // Temporary placeholder
    public $paymentId;
    public $group_id; // For dropdown selection
    public $groups = []; // List of groups for the dropdown

    public function mount()
    {
      
        $this->groups = $this->getGroupsForCurrentUser();
            // ✅ If there's only one group(in drop down), preselect it
        if (count($this->groups) === 1) {
        $this->group_id = $this->groups[0]['group_id'];
        }
        $this->amount = $this->amount[0]; //select 0th index's value by default
        $this->transaction_type = $this->transaction_type[0];

    }


    private function getGroupsForCurrentUser()
    {
        $userId = Session::get('user_id');
        $user = User::with('groups')->where('user_id', $userId)->first();

        if (!$user) return [];

        // Map each group associated with the user to a simplified array structure
       // $group is an individual item from the $user->groups collection.
        // $user->groups is a collection of all groups associated with the user.
        // function($group) is a callback function that processes each group in the $user->groups collection.
        //The map() method is used to transform the collection into a new structure.
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

    public function makePayment()
    {
        if (!$this->amount) {
            session()->flash('payment-error', 'Please select an amount to proceed with payment.');
            return;
        }

        $UserId = session('user_id');
        $user = User::where('user_id', $UserId)->first();

        if (!$user) {
            session()->flash('payment-error', 'User not found. Login again.');
            return;
        }

        $userId = $user->user_id;

        try {
            $transactionId = 'pending_' . Str::uuid()->toString(); // ✅ FIXED
            $paymentId = $this->generatePaymentId($userId); //stores value of generatePaymentId method in $paymentId variable

            UserTransaction::create([
                'payment_id' => $paymentId,
                'transaction_id' => $transactionId,
             //   'transaction_type' => $this->transaction_type,
                'user_id' => $userId,
                'group_id' => $this->group_id, // Save selected group
                'amount' => $this->amount,
             //   'transaction_id' => 'pending', // Temporary placeholder
                'transaction_type' => $this->transaction_type,
            ]);

            session()->flash('payment-success', 'Payment initiated. Waiting for confirmation!');
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
         // Keep generating a new ID until we find one that's unique
            do {
                $random = str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
                $transactionId = $prefix . $user_GroupId . $date . $random;
            } while (UserTransaction::where('transaction_id', $transactionId)->exists());
        //   // Count existing transactions for this user+group+date
        //  $count = UserTransaction::where('user_id', $userId)
        // ->where('group_id', $groupId)
        // ->whereDate('created_at', today())
        // ->count();
        // $newNumber = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        // return $prefix . $user_GroupId . $date . $newNumber;
        return $transactionId;
    }

    public function render()
    {
        return view('livewire.contribution');
    }
}
