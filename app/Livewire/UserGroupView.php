<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\GroupTable; // Make sure to import the GroupTable model
use App\Models\User; // Added User model import


class UserGroupView extends Component
{
    public $groups = [];

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
                ];
            })->toarray();
        }
    }
  //  $group = GroupTable::with('users')->find('group_id');
    public function render()
    {
        return view('livewire.user-group-view');
    }
}
