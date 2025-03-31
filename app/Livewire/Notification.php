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
        if(!auth::check()) {
            return; // Return nothing
        }
        // Get the authenticated user ID
        $userId = Auth::id();
        // Fetch notifications from the UserTransaction table
        $this->notifications = UserTransaction::with('user') // Assuming a relationship exists
            ->where('user_id', $userId) // Filter for the logged-in user
            ->where('transaction_type', 'deposit') // Filter for deposit transactions
            ->orderBy('created_at', 'desc') // Order by latest transactions
            ->get()
            ->map(function ($transaction) {
                return [
                    'user_id' => $transaction->user->id ?? 'Unknown', // Get user ID
                    'user_name' => $transaction->user->name ?? 'Unknown', // Get user name
                    'amount' => $transaction->amount, // Get deposited amount
                    'created_at' => $transaction->created_at->format('d M Y, h:i A'), // Format date
                    // Message to be displayed
                    'message' => ($transaction->user->name ?? 'Someone') . ' deposited ₹' . $transaction->amount . ' on ' . $transaction->created_at->format('d.m.y'), // Create a message
                    'timestamp' => $transaction->created_at->diffForHumans(), // Get relative time
                ];
            })->toArray();
        
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
