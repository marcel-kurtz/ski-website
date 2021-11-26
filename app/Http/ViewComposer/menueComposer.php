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
        if ( Auth::check() ){
            $role = Auth::user()->role;
            $roles = Auth::user()->roles()->pluck('name');
        }
        else {
            $role = '';
            $roles = json_encode([]);
        }

        $view
            ->with('role', $role )
            ->with('roles', $roles );
    }
}
