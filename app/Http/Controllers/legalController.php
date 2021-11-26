<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class legalController extends Controller
{
    public function impressum () {
        return view('layouts.legal.impressum');
    }
    public function datenschutz () {
        return view('layouts.legal.datenschutz');
    }

}
