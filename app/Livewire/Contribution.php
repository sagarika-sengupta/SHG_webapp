<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\UserTransaction;
use Livewire\Component;

class Contribution extends Component
{
    public $user_id;
    public $amount;
    public $transaction_type;

    public function makePayment()
    {
        if (!$this->amount) {
            session()->flash('payment-error', 'Please select an amount to proceed with payment.');
            return;
        }

        $user = Auth::user(); // ✅ Get authenticated user
        $userId = $user->user_id;
        $registeredAmount = $user->monthly_contribution; // ✅ Get amount from user profile (assumed column)

        // ✅ Check if selected amount matches the registered amount
        if ($this->amount != $registeredAmount) {
            session()->flash('payment-invalid_amount', "Invalid amount! You can only contribute ₹$registeredAmount.");
            return;
        }

        try {
            // ✅ Save the transaction
            UserTransaction::create([
                'user_id' => $userId,
                'amount' => $this->amount,
                'transaction_type' => $this->transaction_type,
            ]);

            session()->flash('payment-success', 'Payment successful!');
        } catch (\Exception $e) {
            session()->flash('payment-error', 'An error occurred.');
        }
    }
}
/*
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Contribution extends Component
{
    public $amount;

    public function makePayment()
    {
        if (!$this->amount) {
            $this->dispatchBrowserEvent('payment-error', ['message' => 'Please select an amount to proceed with payment.']);
            return;
        }

        $userId = Auth::user_id(); // Get logged-in user ID

        try {
            $response = Http::post(url('/save-transaction'), [
                'user_id' => $userId,
                'amount' => $this->amount,
                '_token' => csrf_token()
            ]);

            if ($response->successful()) {
                $this->dispatchBrowserEvent('payment-success', ['message' => 'Payment successful!']);
            } else {
                $this->dispatchBrowserEvent('payment-error', ['message' => 'Payment failed.']);
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('payment-error', ['message' => 'An error occurred.']);
        }
    }

    public function render()
    {
        return view('livewire.contribution');
    }
}
*/