<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Livewire\Login;
use App\Models\User; // Make sure to import User model
use App\Models\Group; // Make sure to import Group model
use resources\views\livewire\kyc;



class Home extends Component
{
    public $user_id;
    public $password;
   // public $group_id='ambari001';
   // public $group_password='ambari001';
    //public $isGroupLogin = false; // Toggle between user and group login

    //public $user_id;
    //public $password;

    public function login()
    {
        $credentials = $this->validate([
            'user_id' => ['required', 'user_id'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['user_id' => $this->user_id, 'password' => $this->password])) 
        {
            // Retrieve the authenticated user
        $user = Auth::user() ;
            // Check if KYC is completed
        if (!$user->is_kyc_completed) {
            $this->showKYCModal = true; // Show the KYC modal (in kyc component)
            return;// redirect()->route('kyc'); // Redirect to KYC component
        }

            //$this->dispatch('notify', ['message' => 'Successfully logged in!']);
            return redirect()->route('dashboard');
        }

        $this->addError('user_id', 'The provided credentials do not match our records.');
    }

    public function groupLogin()
    {
        $credentials = $this->validate([
            'group_id' => 'required',
            'group_password' => 'required',
        ]);

        if (Auth::attempt(['group_id' => $this->group_id, 'group_password' => $this->group_password])) {
            return redirect()->route('GroupDashboard'); // Redirect to group dashboard
        }

        session()->flash('error', 'Invalid Group ID or Password.');
    }
    
    public function render()
    {
        return view('livewire.home');
    }
}
