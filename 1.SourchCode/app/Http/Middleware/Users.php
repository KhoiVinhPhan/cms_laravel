<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Users
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ((Auth::check() && Auth::user()->user_permission_id == '1') || (Auth::check() && Auth::user()->user_permission_id == '2')) {
            return $next($request);
        } else {
            return redirect('/check-level');
        }
    }
}
