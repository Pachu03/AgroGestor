<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
{
    foreach ($roles as $role) {
        if (Auth::user()->hasRole($role)) {
            return $next($request);
        }
    }

    Session::flash('error', 'No tienes permiso para acceder a esta página.');
    return redirect('/dashboard');
}

}
