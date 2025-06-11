<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;
use App\Models\User;


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
       // Fetch user with associated groups
       $user = User::with('groups')->where('user_id', $userId)->first();

       if ($user) {
          $this->groups = $user->groups->map(function ($group) {
             return [
                'group_id' => $group->group_id,
                'group_name' => $group->group_name,
                'village' => $group->village,
                'district' => $group->district,
                'state' => $group->state,
                'role' => $group->pivot->role
             ];
          })->toarray();
       }
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.groups-viewof-user');
    }
}
