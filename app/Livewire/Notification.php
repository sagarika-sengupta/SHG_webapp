<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserTransaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Notification extends Component
{
    public $notifications = [];

    public function mount()
    {
        $userId = session('user_id');
        if(!$userId) {
            return; // Return nothing
        }
        // Get the authenticated user ID
       // $userId = Auth::user()->user_id; 
        //dd($userId); //"Dump and Die". It is a debugging tool provided by Laravel to inspect the value of a variable and stop the execution of the script.

        // Fetch notifications from the UserTransaction table
        $this->notifications = UserTransaction::with('user') // user is the model that handles the table: 'users'
            ->where('user_id', $userId) // Filter for the logged-in user
            ->where('transaction_type', 'deposit') // Filter for deposit transactions
            ->orderBy('created_at', 'desc') // Order by latest transactions
            ->get()
            ->map(function ($transaction) //$transaction represents each row (record) from the UserTransaction table.
             {
                return [
                    'user_id' => $transaction->user->user_id ?? 'Unknown', // Get user ID from users table(via user model)
                    'user_name' => $transaction->user->name ?? 'Unknown', // Get user name from users table(via user model)
                    'amount' => $transaction->amount, // Get deposited amount from transaction table
                    'created_at' => $transaction->created_at->format('d M Y, h:i A'), // Format date
                    // Message to be displayed
                    'message' => ($transaction->user->name ?? 'Someone') . ' deposited ₹' . $transaction->amount . ' on ' . $transaction->created_at->format('d.m.y'), // Create a message
                    'timestamp' => $transaction->created_at->diffForHumans(), // Get relative time (eg:'5 mins ago', 'an hour ago', etc)
                ];
            })->toArray();
        
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
