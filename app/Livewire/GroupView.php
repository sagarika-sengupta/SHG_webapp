<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\GroupTable; // Make sure to import the GroupTable model

class GroupView extends Component
{
    public function getGroupsofLeader()
    {
        $userId = Session::get('user_id');
        //return DB::select('SELECT * FROM groups WHERE user_id = ?', [$userId]);
        return GroupTable::where('user_id', $userId)->get(['group_id', 'group_name', 'village', 'district', 'state']);
    }
    public function render()
    {
        return view('livewire.group-view')->layout('components.layouts.app', ['theme' => 'theme-group']);
    }
}
