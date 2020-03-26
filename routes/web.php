<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('oeffentlich.pages.start');
});
Route::get('/whoiswho', function () {
    return view('oeffentlich.pages.start');
});
Route::get('/news', function () {
    return view('oeffentlich.pages.start');
});

// legal
Route::get('/impressum', function () {
    return view('oeffentlich.pages.start');
});
Route::get('/datenschutz', function () {
    return view('oeffentlich.pages.start');
});
Route::get('/satzung', function () {
    return view('oeffentlich.pages.start');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


