<?php

namespace App\Http\ViewComposer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class menueComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $role = '';
        Log::info('menue seeder w. userrole'); 
        if (Auth::user() != null){
            $role = DB::table('user_roles')->select('name')->where('name', Auth::user()->role )->pluck('name')[0];
        }
        else {
            $role = '';
        }
        
        $view->with('role', $role );
    }
}