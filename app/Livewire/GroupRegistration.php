<?php

namespace App\Livewire;

use App\Models\Group;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class GroupRegistration extends Component
{
    public $group_id;
    public $group_name;
    public $village;
    public $district;
    public $state;
    public $members = []; // Array to store member names
    public $group_password;
    public $group_password_confirmation; // For confirming the password

    protected $rules = [
        'group_id' => 'required|min:8|unique:groups,group_id',
        'group_name' => 'required|min:5',
        'village' => 'required',
        'district' => 'required',
        'state' => 'required',
        'group_password' => 'required|min:8|same:group_password_confirmation', // Validate password and confirmation
        'group_password_confirmation' => 'required|min:8', // Confirm password field
        'members' => 'required|array|min:1', // Ensure at least one member is added
        'members.*' => 'required|string|min:3', // Validate each member name
    ];

    public function addMember()
    {
        $this->members[] = ''; // Add an empty field for a new member
    }

    public function removeMember($index)
    {
        unset($this->members[$index]); // Remove the member at the given index
        $this->members = array_values($this->members); // Reindex the array
    }

    public function register()
    {
        $this->validate();

        // Create the group
        $group = Group::create([
            'group_id' => $this->group_id,
            'group_name' => $this->group_name,
            'village' => $this->village,
            'district' => $this->district,
            'state' => $this->state,
            'members' => json_encode($this->members), // Store members as JSON
            'group_password' => Hash::make($this->group_password), // Hash the password before saving
        ]);

        session()->flash('message', 'Group registered successfully!');
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.group-registration');
    }
}