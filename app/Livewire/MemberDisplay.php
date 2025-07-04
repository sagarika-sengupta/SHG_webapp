<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
//use App\Models\Group;
use App\Models\GroupTable; // Make sure to import Group model
//use App\Http\Middleware\GroupAuth; // Make sure to import GroupAuth middleware
use Illuminate\Database\Eloquent\Relations\Pivot;


class MemberDisplay extends Component
{
    public $group_id;
    public $members;
    public $user_id;
    public $village;
    public $state;
    public $group;
    public $group_name;
    public $user_name;
    public $statusFilter = 'all'; // default to show all members
    
    public function updatedStatusFilter()
    {
        $this->mount(); // reload with new filter
    }
    public function filterMembers()
    {
        $group = GroupTable::find(session('group_id'));

        if (!$group) {
            $this->members = collect();
            return;
        }

        $query = $group->users();

        if ($this->statusFilter !== 'all') {
            $query->wherePivot('status', $this->statusFilter);
        }

        $this->members = $query->get();
    }


    public function mount()
    {
        $group = GroupTable::with('users')->find(session('group_id'));
        //$user = Auth::user();

       // $group_name = GroupTable::where('group_name', $this->group_name)->first();
        if ($group) {
            $this->group=$group;
            $this->group_id = $group->group_id;
            $this->group_name = $group->group_name;
            $this->role = $group->role; //in blade file------> <td>{{ $member->pivot->role }}</td> 
            $this->members = $group->users;
            $this->user_id = $group->users->pluck('user_id')->toArray();
            $this->user_name = $group->users->pluck('name')->toArray();
            $this->user_village = $group->users->pluck('village')->toArray();
            $this->user_state = $group->users->pluck('state')->toArray();
            //IMPORTANT:Even if the pivot table only has user_id and group_id, Eloquent's belongsToMany relationship joins the users table so you can access all their fields, like name.
        }
        
        
    }
    

    public function render()
    {
        return view('livewire.member-display');
    }
}
