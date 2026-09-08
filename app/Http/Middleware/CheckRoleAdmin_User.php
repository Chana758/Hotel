<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAdmin_User
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. If the user is an admin, allow them to proceed
        if (Auth::check() && Auth::user()->usertype === 'admin') {
            return $next($request);
        }

        // 2. If not an admin, redirect back to the root (/) so the controller can decide again
        return redirect('/')->with('error', 'You do not have permission to access this page!');
    }
}