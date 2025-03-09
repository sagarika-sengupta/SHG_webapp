<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $phone;
    public $village;
    public $district;
    public $state;
    public $monthly_contribution;
    public $group_id;
    public $user_id;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|min:8',
        'phone' => 'required|min:10',
        'village' => 'required',
        'district' => 'required',
        'state' => 'required',
        'monthly_contribution' => 'required',
        'user_id' => 'required|unique:users,user_id',
        'password' => 'required|min:8|confirmed',
    ];

    public function register()
    {
        $this->validate();

        // Create the user
        $user = \App\Models\User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'village' => $this->village,
            'district' => $this->district,
            'state' => $this->state,
            'monthly_contribution' => $this->monthly_contribution,
            'group_id' => $this->group_id,
            'user_id' => $this->user_id,
            'password' => bcrypt($this->password),
        ]);

        session()->flash('message', 'Account created successfully!');
        // Logout the user
        Auth::logout();
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.register');
    }
}