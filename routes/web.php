<?php

use Illuminate\Support\Facades\Log;
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


Route::get('/', 'HomeController@index');
Route::get('/whoiswho', 'HomeController@whoiswho');
Route::get('/news', 'HomeController@news');
Route::get('/satzung', 'HomeController@satzung');

// legal
Route::get('/impressum', function () {
    return view('oeffentlich.pages.start');
});
Route::get('/datenschutz', function () {
    return view('oeffentlich.pages.start');
});


// Nutzerbereich
Route::group(['prefix' => '/member',  'middleware' => 'userRoleCheck:member'], function () {
    // Matches The "/member/*" URL
        Route::get('/', 'MemberController@index');
        Route::get('/myLizenz', 'MemberController@myLizenz');
        Route::get('/myData', 'MemberController@myData');
        
        Log::info('POST Methoden');
        Route::post('/myData', 'MemberController@updateDaten');
        Route::post('/myData/password', 'MemberController@updatePassword');
        Route::post('/myLizenz', 'MemberController@updateLizenz');
        Route::post('/myLizenz/neu', 'MemberController@addLizenz');
        Route::post('/myLizenz/delete', 'MemberController@deleteLizenz');

    }); 
Route::get('/myLizenz', function () {return redirect('member/myLizenz');});
Route::get('/myData', function () {return redirect('member/myData');});
// POST Methoden
        
    
// vorstand
Route::group(['prefix' => '/vorstand',  'middleware' => 'userRoleCheck:vorstand'], function () {
    // Matches The "/vorstand/*" URL
        Route::get('/', 'VorstandController@index');
    });

// admin
Route::group(['prefix' => '/admin',  'middleware' => 'userRoleCheck:admin'], function () {
    // Matches The "/admin/*" URL
        Route::get('/', 'AdminController@index');
        Route::get('/vorstand', 'AdminController@VorstandVerwalter');
    }); 


    Auth::routes();