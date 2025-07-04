<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
//use App\Models\Group;
use App\Models\GroupTable; // Make sure to import Group model
use App\Models\GroupSettings;
use App\Http\Middleware\GroupAuth; // Make sure to import GroupAuth middleware
use Illuminate\Support\Facades\DB;


class UserApproval extends Component
{
    public $pendingRequests = [];

    public function mount()
    {
        $this->loadPendingRequests();
    }

    public function loadPendingRequests()
    {
        $userId = session('user_id');
        // Load *all* pending user requests across groups
        $pending = DB::table('group_user')
            ->where('status', 'pending')
            ->where('user_id', $userId)
            ->get();

        $requests = collect();

        foreach ($pending as $item) {
            $user = User::find($item->user_id);
            $group = GroupTable::find($item->group_id);
            $settings = GroupSettings::find($item->group_id);

            if ($user && $group && $settings) {
                $user->group_id = $group->group_id;
                $user->group_name = $group->group_name;

                // Get the name of the group's creator (leader/admin)
                $creator = User::find($settings->created_by);
                $user->created_by_name = $creator ? $creator->name : 'N/A';

                $user->created_at = $item->created_at;

                $requests->push($user);
            }
        }

        $this->pendingRequests = $requests;
    }

    public function approve($userId, $groupId)
    {
        DB::table('group_user')
            ->where('user_id', $userId)
            ->where('group_id', $groupId)
            ->update(['status' => 'active']);

        $count = DB::table('group_user')
            ->where('group_id', $groupId)
            ->where('status', 'active')
            ->count();

        DB::table('group_settings')
            ->where('group_id', $groupId)
            ->update(['user_count' => $count]);

        session()->flash('message', 'User approved successfully.');
        $this->loadPendingRequests();
    }

    public function reject($userId, $groupId)
    {
        DB::table('group_user')
            ->where('user_id', $userId)
            ->where('group_id', $groupId)
            ->update(['status' => 'rejected']);

        $count = DB::table('group_user')
            ->where('group_id', $groupId)
            ->where('status', 'active')
            ->count();

        DB::table('group_settings')
            ->where('group_id', $groupId)
            ->update(['user_count' => $count]);

        session()->flash('message', 'User rejected.');
        $this->loadPendingRequests();
    }

    public function render()
    {
        return view('livewire.user-approval');
    }
}
