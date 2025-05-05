<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;    
use Illuminate\Support\Facades\DB;

class viewController extends Controller
{
    public function accessGroupMemberPage()
    {
        $user = DB::table('users')->where('user_id', user_id)->first();
        // Check if the user is logged in and has the role of group member

        if ($user && $user->role == 1) {
            return view('GroupBar');
    }
}
}
