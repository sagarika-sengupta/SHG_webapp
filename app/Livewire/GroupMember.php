<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
//use App\Models\Group;
use App\Models\GroupTable; // Make sure to import Group model
use App\Http\Middleware\GroupAuth; // Make sure to import GroupAuth middleware

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

        try 
        {
            if($group)
            {
            $group->users()->attach($this->user_id);
            session()->flash('message', 'Member added successfully!');
            return;
            }
        } catch (\Exception $e) {
           // \Log::error('Error adding member to group: ' . $e->getMessage());
           if ($group->users()->where('users.user_id', $this->user_id)->exists()) {
            session()->flash('error', 'User already exists in this group.');
            return;
        } 
        else{
           session()->flash('error', 'An error occurred while adding the member. Please try again.');
            return;
        }
                   }


       // return back()->with('message', 'Member added successfully!');
    }

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
        //$user = User::where('user_id', $this->user_id)->first();

        try 
        {
            if($group)
            {
            $group->users()->detach($this->user_id);
            session()->flash('message', 'Member removed successfully!');
            return;
            }
        } catch (\Exception $e) {
           // \Log::error('Error adding member to group: ' . $e->getMessage());
           if ($group->users()->where('users.user_id', $this->user_id)->exists()) {
            session()->flash('error', 'User already exists in this group.');
            return;
        } 
        else{
           session()->flash('error', 'An error occurred while adding the member. Please try again.');
            return;
        }
        // $group = Group::find($this->group_id);
        // if ($group) {
        //     $group->users()->detach($this->user_id);
        //     session()->flash('message', 'Member removed successfully!');
        // }
        // //return back()->with('message', 'Member removed successfully!');
    }
    }
    public function render()
    {
        return view('livewire.group-member')->layout('components.layouts.app', ['theme' => 'theme-group']);;
    }
}
