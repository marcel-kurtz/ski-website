<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\Input;

class AdminController extends Controller
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
        $users = DB::table('users')
            ->get();

        return view('admin.pages.home')
            ->with('users',$users);
    }

    public function VorstandVerwalter()
    {
        $admins = User::where('role', 'admin')
            ->get();
        $vorstaende = User::where('role', 'vorstand')
            ->get();
        $usersNoVorstand = User::where('role','!=', 'vorstand')
            ->get();
        $usersNoAdmin = User::where('role','!=', 'admin')
            ->get();
        Log::info($admins);
        Log::info($vorstaende);
        Log::info($usersNoVorstand);
        Log::info($usersNoAdmin);
        return view('admin.pages.VorstandVerwalter')
            ->with('admins', $admins)
            ->with('vorstaende', $vorstaende)
            ->with('usersNoVorstand', $usersNoVorstand)
            ->with('usersNoAdmin', $usersNoAdmin);
    }
    public function addVorstand(Request $request){
        if ($request->input('addVorstand') != null) {
            Log::info($request->input('addVorstand'));
            $name = explode(";", $request->input('addVorstand'))[0];
            $firstname = explode(";", $request->input('addVorstand'))[1];
            DB::table('users')
                ->where('name', $name)
                ->where('firstname', $firstname)
                ->update(['role' => 'vorstand']);
        }
        return redirect('/admin/vorstand');
    }
    public function addAdmin(Request $request){
        if ($request->input('addAdmin') != null) {
            $name = explode(";", $request->input('addAdmin'))[0];
            $firstname = explode(";", $request->input('addAdmin'))[1];
            DB::table('users')
                ->where('name', $name)
                ->where('firstname', $firstname)
                ->update(['role' => 'admin']);
        }
        return redirect('/admin/vorstand');
    }
    public function delVorstand(Request $request){
        DB::table('users')
            ->where('id', $request->input('userId'))
            ->update(['role' => 'member']);
        return redirect('/admin/vorstand');
    }
    public function delAdmin(Request $request){
        DB::table('users')
        ->where('id', $request->input('userId'))
        ->update(['role' => 'member']);
    return redirect('/admin/vorstand');
    }

}
