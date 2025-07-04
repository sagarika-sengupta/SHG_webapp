<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
//use App\Models\Group;
use App\Models\GroupTable; // Make sure to import Group model
use App\Http\Middleware\GroupAuth; // Make sure to import GroupAuth middleware
use App\Models\GroupSettings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class GroupMember extends Component
{
    public $user_id;
    public $group_id;

    public function mount()
    {
        $this->group_id = session('group_id');

         //dd($this->group_id);
        
    }
    public function addMember()
    {
        
       // dd($this->group_id);
        $this->validate([
            'group_id' => 'required|exists:groups,group_id',
            'user_id' => 'required|exists:users,user_id',
        ]);
        $this->group_id = session('group_id');
            //dd('group_id=' . $this->group_id . ' user_id=' . $this->user_id);
        $group = GroupTable::where('group_id', $this->group_id)->first();
        //$user = User::where('user_id', $this->user_id)->first();
        if (!$group) {
                session()->flash('error', 'Group not found.');
                return;
            }

        try {
            // Add or update pivot row with status='pending' and role='member'
            // $group->users()->syncWithoutDetaching([
            //     $this->user_id => [
            //         'status' => 'pending',
            //         'role'   => 'member',
            //         'date_of_joining' => now(),
            //     ]
            // ]);
            $exists = DB::table('group_user')
            ->where('group_id', $this->group_id)
            ->where('user_id', $this->user_id)
            ->exists();

            if ($exists) {
                session()->flash('error', 'User is already a member of this group.');
                return;
            }
            $group->users()->attach($this->user_id, [
            'status' => 'pending',
            'role'   => 'member',
            'date_of_joining' => now(),
        ]);

            session()->flash('message', 'Request for adding member in the group successfully sent!');
        } catch (\Exception $e) {
            Log::error('Error adding member to group: ' . $e->getMessage());
            session()->flash('error', 'An error occurred while adding the member. Please try again.');
        }
                    }


       // return back()->with('message', 'Member added successfully!');

    // Remove a user from a group
    public function removeMember()
    {
        $this->validate([
            'group_id' => 'required|exists:groups,group_id',
            'user_id' => 'required|exists:users,user_id',
        ]);

        $this->group_id = session('group_id');
            //dd('group_id=' . $this->group_id . ' user_id=' . $this->user_id);
        $group = GroupTable::where('group_id', $this->group_id)->first();
        $groupsettings =GroupSettings::where('group_id', $this->group_id)->first();
        //$user = User::where('user_id', $this->user_id)->first();

         try {
        // Remove from pivot
        $group->users()->detach($this->user_id);

        // Recalculate user_count
        $count = DB::table('group_user')
            ->where('group_id', $this->group_id)
            ->where('status', 'active')
            ->count();

        DB::table('group_settings')
            ->where('group_id', $this->group_id)
            ->update(['user_count' => $count]);

        session()->flash('message', 'Member removed successfully!');
    } catch (\Exception $e) {
        Log::error('Error removing member from group: ' . $e->getMessage());
        session()->flash('error', 'An error occurred while removing the member.');
    }
    
    }
    public function render()
    {
        return view('livewire.group-member')->layout('components.layouts.app', ['theme' => 'theme-group']);;
    }
}
