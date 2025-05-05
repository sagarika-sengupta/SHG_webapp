<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupLogoutController extends Controller
{
    public function group_logout()
    {
    session()->forget(['group_id','group_logged_in','group_name']);
    session()->invalidate();
    session()->regenerateToken();

    return redirect('/');
    }
}
