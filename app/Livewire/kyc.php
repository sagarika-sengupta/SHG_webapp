<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Make sure to import User model

class kyc extends Component
{
    public $showModal = false;
    public $kyc_data = '';

    protected $rules = [
        'kyc_data' => 'required|min:5',
    ];

    public function submitKYC()
    {
        $this->validate();

        // Save KYC Data
        //auth()->user()->update(['is_kyc_completed' => 1]);
        $userId = session('user_id');
        if ($userId) {
            // Update the authenticated user's KYC status
            $user = User::where('user_id', $userId)->first();
            if ($user) {
                $user->update(['is_kyc_completed' => 1]);
                $user->update(['kyc_data' => $this->kyc_data]);
            }

        }
        // Hide modal after submission
        $this->showModal = false;

        session()->flash('message', 'KYC Completed Successfully!');

        return redirect()->route('dashboard');
    }
    /*public function mount()
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if KYC is already completed
        $user = Auth::user();
        if ($user->is_kyc_completed) {
            return redirect()->route('dashboard');
        }
    }*/
    public function render()
    {
        return view('livewire.kyc');
    }
}
