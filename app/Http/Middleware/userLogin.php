<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class userLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        // Check if the current route is already the home route to prevent redirect loops
        if ($request->routeIs('home') || $request->routeIs('login')) {
            return $next($request);
        }
        // Check if user is logged in using our custom session variables
        if (!session()->has('user_logged_in') || !session()->has('user_id')) {
            
            // Redirect to login page
            return redirect()->route('home');
        }
        return $next($request);
    }
}
