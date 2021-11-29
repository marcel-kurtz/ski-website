<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('oeffentlich.pages.start');
    }
    public function whoiswho() {
        return view('oeffentlich.pages.whoiswho');
    }
    public function satzung() {
        return view('oeffentlich.pages.satzung');
    }
    public function news() {
        return view('oeffentlich.pages.news');
    }
}
