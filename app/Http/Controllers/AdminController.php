<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $admins = DB::table('users')
            ->where('role', 'admin')
            ->get();
        $vorstaende = DB::table('users')
            ->where('role', 'vorstand')
            ->get();
        $usersNoVorstand = DB::table('users')
            ->where('role','!=', 'vorstand')    
            ->get();
        $usersNoAdmin = DB::table('users')
            ->where('role','!=', 'admin')    
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
        Log::info($request->input('addVorstand'));
        $name = explode(";", $request->input('addVorstand'))[0];
        $firstname = explode(";", $request->input('addVorstand'))[1];
        DB::table('users')
            ->where('name', $name)
            ->where('firstname', $firstname)
            ->update(['role' => 'vorstand']);
        return redirect('/admin/vorstand');   
    }
    public function addAdmin(Request $request){
        $name = explode(";", $request->input('addAdmin'))[0];
        $firstname = explode(";", $request->input('addAdmin'))[1];
        DB::table('users')
            ->where('name', $name)
            ->where('firstname', $firstname)
            ->update(['role' => 'admin']);
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
