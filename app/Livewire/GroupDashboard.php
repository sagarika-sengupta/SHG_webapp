<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GroupTable;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\GroupAuth;
use App\Models\UserTransaction;

class GroupDashboard extends Component
{
    public $group_id;
    public $group_name;
    public $village;
    public $district;
    public $state;
    public $members_count;
    public $members;
    public $TotalAmount;
    public $groupBalances;
    
//added a pivot table in models -> User & Group  EG:  return $this->belongsToMany(GroupTable::class, 'group_user', 'user_id', 'group_id')->withPivot('role')->withTimestamps();

    public function mount()
    {
        //The code below is used to get the group_id from the session from groups table only. it has nothing to do with the users table.
        //$group = GroupTable::where('group_id', session('group_id'))->first();
        
        //IMPORTANT:Use the line below to acccess the pivot table(group_user) and get the users in the group
    $group = GroupTable::with('users')->find(session('group_id'));

    // Group-wise available balance
    $this->TotalAmount = UserTransaction::where('group_id', $group->group_id)
        ->where('status', 'approved') // Only approved transactions
        ->sum('amount');

    $this->groupBalances[] = [
        'group_name' => $group->group_name,
        'amount' => $this->TotalAmount
    ];
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
            $this->members_count = $group->users->count();
            $this->members = $group->users; // Get users from the relationship

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
