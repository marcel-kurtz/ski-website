<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class VorstandController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mitglieder = User::where('aktiv', true)
                        ->get();

        return view('Vorstand.pages.home')
            ->with('mitglieder', $mitglieder);
    }
}
