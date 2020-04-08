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
        Log::info($check_user_role);
        Log::info(Auth::user()->role);
        if (Auth::check()) 
        {
            //Case logged in
            $roles = DB::table('user_roles as a')
                ->join('user_roles as b', 'a.includes', '=','b.id' , 'right')
                ->where('a.name' , '=', Auth::user()->role )
                ->select('b.name as name')
                ->get();
            Log::info($roles);
            $roleArray = [];
            $roleArray[] = Auth::user()->role;
            foreach ($roles as $role) {
                Log::info($role->name);
                $roleArray[] = $role->name;
            }
            Log::info(json_encode($roleArray));
            foreach ($roleArray as $key => $value) {
                if ( $roleArray[$key] == $check_user_role ) { 
                    // Weiterleitung
                    return $next($request);
                } 
            }
        }
        //default
        return redirect(RouteServiceProvider::HOME);
    }
}
