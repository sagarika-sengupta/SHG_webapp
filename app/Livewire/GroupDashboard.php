<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GroupTable;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\GroupAuth;

class GroupDashboard extends Component
{
    public $group_id;
    public $group_name;
    public $village;
    public $district;
    public $state;
    public $members_count;
    public $members;


    public function mount()
    {
        //The code below is used to get the group_id from the session from groups table only. it has nothing to do with the users table.
        //$group = GroupTable::where('group_id', session('group_id'))->first();
        
        //IMPORTANT:Use the line below to acccess the pivot table(group_user) and get the users in the group
        $group_user = GroupTable::with('users');
        $group = GroupTable::find(session('group_id'));
        
        //$user = Auth::users(); // ✅ Get the authenticated user
        
        if ($group) {
            $this->group_id = $group->group_id; // ✅ Assuming 'village' is the branch
            $this->group_name = $group->group_name;
            $this->village = $group->village; 
            $this->district = $group->district;
            $this->state = $group->state;
            $this->members_count = $group->users()->count();
            $this->members = $group->members; // Assuming 'members' is a field in your group table  
        }
        //$branch = $users->village;
        //$accountNumber = $users->user_id;
        //$this->userId = $users->user_id;

        // Calculate the available balance
       // $this->availableBalance = UserTransaction::where('user_id', $this->userId)
       //     ->where('transaction_type', 'deposit')
       //     ->sum('amount');
        
        
    }
    public function render()
    {
        return view('livewire.group-dashboard');
    }
}
