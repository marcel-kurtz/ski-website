<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('oeffentlich.pages.start');
    }

    public function whoiswho()
    {
        return view('oeffentlich.pages.whoiswho');
    }

    public function news()
    {
        return view('oeffentlich.pages.news');
    }

    public function satzung()
    {
        return view('oeffentlich.pages.satzung');
    }
}
