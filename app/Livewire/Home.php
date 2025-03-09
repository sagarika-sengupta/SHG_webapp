<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Livewire\Login;


class Home extends Component
{

    public $user_id;
    public $password;

    public function login()
    {
        $credentials = $this->validate([
            'user_id' => ['required', 'user_id'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['user_id' => $this->user_id, 'password' => $this->password])) {
            //$this->dispatch('notify', ['message' => 'Successfully logged in!']);
            return redirect()->route('dashboard');
        }

        $this->addError('user_id', 'The provided credentials do not match our records.');
    }


    
    public function render()
    {
        return view('livewire.home');
    }
}
