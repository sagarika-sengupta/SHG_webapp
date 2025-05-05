<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\UserTransaction;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\User; // Make sure to import User model

class Contribution extends Component
{
    public $user_id;
    public $amount;
    public $transaction_type;
    public $transactionId;

    public function makePayment()
    {
        if (!$this->amount) {
            session()->flash('payment-error', 'Please select an amount to proceed with payment.');
            return;
        }

        $sessionUserId = session('user_id'); 
        // 2. Check if user exists in the users table
        $user = User::where('user_id', $sessionUserId)->first(); // ✅ Retrieve user from database using session user_id
       if(!$user) {
            session()->flash('payment-error', 'User not found. login again.');
            return;
        }
        // $registeredAmount = $user->monthly_contribution; // ✅ Get amount from user profile (assumed column)
        $userId = $user->user_id; // ✅ Get the authenticated user's ID


        try {
            // Generate the transaction ID
            $transactionId = $this->generateTransactionId($userId); //send the user ID

            // ✅ Save the transaction
            UserTransaction::create([
                'transaction_id' => $transactionId,
                'user_id' => $userId,
                'amount' => $this->amount,
                'transaction_type' => $this->transaction_type,
            ]);

            session()->flash('payment-success', 'Payment successful!');
        } catch (\Exception $e) {
            session()->flash('payment-error', 'An error occurred.');
        }
    }
    private function generateTransactionId($userId) //pass the user ID
    {
        $prefix = 'TRNRD';
        $user_id = $userId; // Get the authenticated user's ID
        $date = date('dmY'); // Format: ddMMyyyy
        // Get the last transaction for today
            // Get the last transaction based on the latest created_at timestamp
        $lastTransaction = UserTransaction::latest('created_at')->first();

        // Extract the last 3 digits, if no transaction exists, start from 001
        $lastNumber = $lastTransaction ? intval(substr($lastTransaction->transaction_id, -3)) : 0;

        
        // Increment and format it to always have 3 digits (001, 002, 003, ...)
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $transactionId = $prefix . $user_id . $date . $newNumber;

        return $transactionId;

        //$lastTransaction = UserTransaction::whereDate('created_at', Carbon::today())
          // ->orderBy('id', 'desc')
           //->first();
    
        // If no previous transaction, start with 001
        //$lastNumber = $lastTransaction ? intval(substr($lastTransaction->transaction_id, -3)) : 0;
        //$newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    
        $transactionId = $prefix . $date;// $newNumber;
        //. $date
        //\Log::info("Generated Transaction ID: " . $transactionId); // Debugging
    
        return $transactionId;
    }

    public function render()
    {
        return view('livewire.contribution');
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