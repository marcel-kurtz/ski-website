<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $check_user_role)
    {
        if (
            Auth::check()
            && Auth::user()->hasRole($check_user_role)
            ) {
            // user has role -> pass on
            return $next($request);
        }

        //default // user does not has role
        if (Auth::check()) { return back(); }
        return redirect(RouteServiceProvider::HOME );
    }
}
