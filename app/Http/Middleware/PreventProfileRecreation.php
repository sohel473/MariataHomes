<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreventProfileRecreation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                // Redirect admin users to a different route
                return redirect('/profile')->with('failure', "Admins don't need profiles.");
            }

            if (Auth::user()->profile) {
                return redirect('/profile')->with('failure', 'You have already created a profile.');
            }
        }
        return $next($request);
    }
}
