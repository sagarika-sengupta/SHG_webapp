<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 
use App\Models\Group;

class Login extends Component
{
    public $user_id;
    public $password;
    public $group_id;    // Uncommented and removed default value
    public $group_password;  // Uncommented and removed default value
    public $showKYCModal = false;  // set the default to false

    public function login()
    {
        $this->validate([
            'user_id' => ['required'],  // Removed invalid 'user_id' rule
            'password' => ['required'],
        ]);

        $user = User::where('user_id', $this->user_id)->first();
    
        if (!$user || !Hash::check($this->password, $user->password)) {
            $this->addError('user_id', 'Invalid credentials');
            return;
        }
        
        // Manually create a session
        session()->put('user_id', $user->user_id);
        session()->put('user_logged_in', true);
        session()->put('user_name', $user->name);
        session()->put('is_kyc_completed', $user->is_kyc_completed);
        
        // Check if KYC is completed
        if (!$user->is_kyc_completed) {
            $this->showKYCModal = true; // Show the KYC modal
            return; // Return here to prevent the redirect
        }

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
