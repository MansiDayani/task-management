<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // If user is not authenticated, redirect to login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Check if user's role is in the allowed roles list
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // User doesn't have the required role, redirect with error
        return redirect()->route('home')->with('error', 'You do not have permission to access this resource.');
    }
}
