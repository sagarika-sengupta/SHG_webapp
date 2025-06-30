<?php

namespace App\Livewire;

use App\Models\GroupTable;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
//use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\User; // Make sure to import User model
use Illuminate\Support\Facades\Log; // Import Log facade
use Illuminate\Support\Facades\DB; // Import DB facade
//use Illuminate\Database\Eloquent\Model;



class GroupRegistration extends Component
{
    
    public $group_id;
    public $group_name;
    public $village;
    public $district;
    public $state;
    public $user_id; // ✅ Add this
    public $group_password;
    public $group_password_confirmation;

    protected $rules = [
        'group_name' => 'required|min:5|unique:groups,group_name',
        'village' => 'required',
        'district' => 'required',
        'state' => 'required',
        'user_id' => 'required|exists:users,user_id', // ✅ Validate it exists
        'group_password' => 'required|min:8|same:group_password_confirmation',
        'group_password_confirmation' => 'required|min:8',
    ];

    public function group_register()
    {
        try {
            // ✅ Fetch user and check KYC status
        $user = User::where('user_id', $this->user_id)->first();

        if (!$user || $user->is_kyc_completed != 1) {
            session()->flash('error', 'User has not completed KYC. Cannot register group.');
            return;
        }

        // Generate group ID
            $this->group_id = strtolower(substr(str_replace(' ', '_', $this->group_name), 0, 4)) . rand(100,999);
            $this->validate();

            // ✅ Create group
            $group = GroupTable::create([
                'group_id' => $this->group_id,
                'group_name' => $this->group_name,
                'village' => $this->village,
                'district' => $this->district,
                'state' => $this->state,
                'user_id' => $this->user_id, // ✅ Use validated user_id
                'group_password' => Hash::make($this->group_password),
            ]);

            // ✅ Update user role
            $user = User::where('user_id', $this->user_id)->first();
            if ($user) {
                $user->role = 1;
                $user->save();
            }
            // Update pivot table with role
            DB::table('group_user')->updateOrInsert(
                ['group_id' => $this->group_id, 'user_id' => $this->user_id],
                ['role' => 'leader',
                'created_at' => now(),
                'updated_at' => now()]
            );
            session()->flash('message', 'Account created successfully!');
            session()->flash('group_id', $this->group_id);
            return ['group_id' => $this->group_id]; //  Return group_id
        } catch (\Exception $e) {
            Log::error('Error creating group: ' . $e->getMessage());
            session()->flash('error', 'An error occurred while creating the group. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.group-registration');
    }
}