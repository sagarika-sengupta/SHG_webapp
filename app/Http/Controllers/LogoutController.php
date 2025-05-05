<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        session()->forget(['user_id', 'user_logged_in', 'user_name', 'is_kyc_completed']);
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }
}
