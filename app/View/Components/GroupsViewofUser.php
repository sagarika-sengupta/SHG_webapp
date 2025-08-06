<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\GroupTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class GroupsViewofUser extends Component
{
    /**
    * Create a new component instance.
    */
    public $groups = [];

    public function __construct()
    {
       $this->mount();
    }

    public function mount()
    {
       $this->getGroupsofUser();
    }

   public function getGroupsofUser()
{
    $userId = Session::get('user_id');
    Log::info("Fetching active groups for user_id: " . $userId);

    $groups = DB::table('group_user')
        ->join('groups', 'group_user.group_id', '=', 'groups.group_id')
        ->where('group_user.user_id', $userId)
        ->where('group_user.status', '=', 'active') // 👈 filter by status here
        ->select(
            'groups.group_id',
            'groups.group_name',
            'groups.village',
            'groups.district',
            'groups.state',
            'group_user.role',
            'group_user.status'
        )
        ->get();

    foreach ($groups as $group) {
        Log::info("Included Group - ID: {$group->group_id}, Role: {$group->role}, Status: {$group->status}");
    }

    $this->groups = $groups->toArray(); // or keep as collection if using object notation in Blade
}



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.groups-viewof-user');
    }
}
