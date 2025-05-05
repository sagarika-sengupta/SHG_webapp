<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserTransaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionHistory extends Component
{
    public $transactions = []; // Array to hold transaction data. called in the blade file as @forelse($transactions as $transaction)

    public function mount()
    {
        $userId = session('user_id'); 
        if(!$userId) {
            return; // Return nothing
        }
        // Get the authenticated user ID
        
        //dd($userId); //"Dump and Die". It is a debugging tool provided by Laravel to inspect the value of a variable and stop the execution of the script.

        // Fetch notifications from the UserTransaction table
        $this->transactions = UserTransaction::with('user') // Assuming a relationship exists
            ->where('user_id', $userId) // Filter for the logged-in user
            ->where('transaction_type', 'deposit') // Filter for deposit transactions
            ->orderBy('created_at', 'desc') // Order by latest transactions
            ->get();
            // ->map(function ($transactions) {
            //     return [
            //         'user_id' => $transactions->user->user_id ?? 'Unknown', // Get user ID
            //         'transaction_id' => $transactions->transaction_id, // Get transaction ID
            //         'user_name' => $transactions->user->name ?? 'Unknown', // Get user name
            //         'amount' => $transactions->amount, // Get deposited amount
            //         'created_at' => $transactions->created_at->format('d M Y, h:i A'), // Format date
            //         // Message to be displayed
            //         //'message' => ($transactions->user->name ?? 'Someone') . ' deposited ₹' . $transaction->amount . ' on ' . $transaction->created_at->format('d.m.y'), // Create a message
            //         'timestamp' => $transactions->created_at->diffForHumans(), // Get relative time
            //     ];
           // });

        }
    public function render()
    {
        return view('livewire.transaction-history');
    }
}
