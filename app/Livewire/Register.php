<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\User; // Make sure to import User model

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
        'monthly_contribution' => 'required|numeric',
        'password' => 'required|min:8|confirmed',
    ];

    public function register()
    {
       

        // Generate a unique user ID dynamically
        $this->user_id = strtolower(substr(str_replace(' ', '_', $this->name), 0, 4)) . rand(100,999);

        // Ensure uniqueness in the database
        //while (User::where('user_id', $this->user_id)->exists()) {
         //   $this->user_id = strtolower(str_replace(' ', '_', $this->name)) . str::random(10);
        //}
        $this->validate();
        // Create the user
        $user = User::create([
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

        if (!$user) {
            session()->flash('error', 'Failed to create account. Please try again.');
            return;
        }

    
        \Log::info("Generated User ID: " . $this->user_id); // Log the user ID for debugging
        session()->flash('message', 'Account created successfully!');
        session()->flash('user_id', $this->user_id);
        // Now dispatch event with user_id
        //$this->dispatch('show-user-id-modal', ['user_id' => $this->user_id]);
         // Trigger a Livewire event to show the modal
       //return 
       //$this->dispatch('show-user-id-modal', ['user_id' => $this->user_id]);
        // Check if the user was created successfully
        //if (!$user) {
          //  session()->flash('error', 'Failed to create account. Please try again.');
            //return;
        //}
        // Store user ID in session
        //session()->flash('message', 'Account created successfully!');
        //session()->flash('user_id', $this->user_id);

        // Trigger a Livewire event to show the modal
       //return 
      // $this->dispatch('show-user-id-modal', ['user_id' => $this->user_id]);
       //session()->flash( 'Your User ID is '.$this->user_id);
       //$this->dispatch('show-user-id-modal', ['user_id' => $this->user_id]);

       // Redirect to the home page
       // return session()->flash('user_id', 'Your User ID is '.$this->user_id);
        //redirect()->route('home');
    }
   // public function redirectToLogin()
   // {
   //     return redirect()->route('home'); // Replace 'home' with your actual login route
   // }
    public function render()
    {
        return view('livewire.register');
    }
}
