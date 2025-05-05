<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Added Hash facade import
use Livewire\Component;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Session; // Added Session facade import
use App\Livewire\Login;
// Remove this incorrect import: use resources\views\livewire\kyc;

class Home extends Component
{

    
    public function render()
    {
        return view('livewire.home');
    }
}