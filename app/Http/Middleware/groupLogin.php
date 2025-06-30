<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class groupLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in
        if (
            session()->has('group_id') &&
            session('group_logged_in') === true
        ) {
            return $next($request); // Allow access
        }

        // Otherwise, redirect to home page
        return redirect()->route('home');
    }
}
