<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class viewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in and has the role of group member
        $user = $request->user();

        // Manually create a session
        // if ($user) {
        //     session()->put('user_id', $user->id);
        //     session()->put('user_logged_in', true);
        //     session()->put('user_name', $user->name);
        //     session()->put('is_kyc_completed', $user->is_kyc_completed);
        // }
            
        if ($user && $user->role != 1) {
            // If the user is not a group leader, redirect to the home page with an error message
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }
        return $next($request);
    }
}
