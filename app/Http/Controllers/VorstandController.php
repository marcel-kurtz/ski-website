<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VorstandController extends Controller
{
    public function index()
    {
        return view('Vorstand.pages.home');
    }
}
