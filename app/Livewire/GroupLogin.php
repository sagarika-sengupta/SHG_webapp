<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GroupTable;
use Illuminate\Support\Facades\Hash; // Added Hash facade import
use Illuminate\Support\Facades\Session; // Added Session facade import
use App\Livewire\Login; // Added Login component import
use App\Http\Middleware\GroupAuth; // Make sure to import GroupAuth middleware
use App\Models\User; // Added User model import

class GroupLogin extends Component
{
    public $user_id;
    public $password;
    public $group_id;    // Uncommented and removed default value
    public $group_password;  // Uncommented and removed default value
    public $group;
    public function groupLogin()
    {
        $this->validate([
            'group_id' => 'required',
            'group_password' => 'required',
        ]);

        $group = GroupTable::where('group_id', $this->group_id)->first();

        if ($group && Hash::check($this->group_password, $group->group_password)) {
            session()->put('group_id', $group->group_id);
            session()->put('group_logged_in', true);
            session()->put('group_name', $group->group_name);

            return redirect()->route('GroupDashboard');
        }
        
        session()->flash('error', 'Invalid Group ID or Password.');
    }
    
    public function render()
    {
        return view('livewire.group-login')->layout('components.layouts.app', ['theme' => 'theme-group']);;
    }
}
