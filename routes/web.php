<?php

use App\Http\Controllers\BeitragsController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VeranstaltungsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\legalController;
use App\Http\Controllers\AdminController;

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


Route::get('/', [HomeController::class, 'index'])->name('start');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/whoiswho', [HomeController::class, 'whoiswho'])->name('whoiswho');
Route::get('/satzung', [ HomeController::class , 'satzung' ])->name('satzung');
Route::get('/news', [ HomeController::class , 'news' ])->name('news');

// legal
Route::get('/datenschutz', [ legalController::class , 'datenschutz' ])->name('datenschutz');
Route::get('/impressum', [ legalController::class , 'impressum' ])->name('impressum');


// für Veranstalter
Route::group(['prefix' => 'veranstaltungsManagement',  'middleware' => 'userRoleCheck:veranstalter'], function () {
    Route::get('', [ VeranstaltungsController::class , 'manageIndex' ]) -> name('veranstaltung_manage_index');
    Route::get('show/{id}', [ VeranstaltungsController::class , 'manageShow' ])->name('manageVeranstaltungShow');

    Route::post('save/{id}', [ VeranstaltungsController::class , 'manageSave' ]);

    Route::get('create', [ VeranstaltungsController::class , 'manageNewVeranstaltung' ]) -> name('veranstaltung_manage_create');
    Route::post('create', [ VeranstaltungsController::class , 'manageCreate' ]) -> name('veranstaltung_manage_create_post');

    Route::get('addFile/{veranstaltungsId}', [ VeranstaltungsController::class , 'showAddFile' ]) -> name('Veranstaltung_addFile_show');
    Route::post('addFile/{veranstaltungsId}', [ VeranstaltungsController::class , 'AddFile' ]) -> name('Veranstaltung_addFile');
    Route::post('deleteFile', [ VeranstaltungsController::class , 'DeleteFile' ]) -> name('Veranstaltung_deleteFile');

    Route::get('AddNoneMember/{veranstaltungsId}', [ VeranstaltungsController::class , 'NichtmitgliedAdd' ]) -> name('Veranstaltung_Nichtmitglied_hinzufuegen');
    Route::post('SubmitAddNoneMember', [ VeranstaltungsController::class , 'SubmitNichtmitgliedAdd' ]) -> name('Veranstaltung_Nichtmitglied_hinzufügen_Submit');
    Route::post('DeleteNoneMember', [ VeranstaltungsController::class , 'NichtmitgliedDelete' ]) -> name('Veranstaltung_Nichtmitglied_loeschen');

    Route::post('changeActiveStatus', [VeranstaltungsController::class , 'manageChangeActiveStatus']);
    Route::post('deleteVeranstaltung', [VeranstaltungsController::class , 'manageDeleteVeranstaltung']);
});
// veranstaltungen
Route::group(['prefix' => 'veranstaltungen'], function () {
    Route::get('', [ VeranstaltungsController::class , 'index']);
    Route::get('show/{id}', [ VeranstaltungsController::class , 'show' ]);
    Route::group(['middleware' => 'userRoleCheck:member'], function () {
        Route::get('anmelden/{id}', [ VeranstaltungsController::class , 'anmelden' ])->name('Veranstaltung_anmelden');
        Route::post('anmelden/{id}/submit', [ VeranstaltungsController::class , 'anmeldenSubmit' ])->name('Veranstaltung_anmelden_submit');
    });
});



// Nutzerbereich
Route::group(['prefix' => '/member',  'middleware' => 'userRoleCheck:member'], function () {
    // Matches The "/member/*" URL
        Route::get('/', 'MemberController@index');
        Route::get('/myLizenz', 'MemberController@myLizenz');
        Route::get('/myData', 'MemberController@myData');

        //POST
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
        Route::get('/', [AdminController::class, 'index']);
        Route::get('/vorstand', [AdminController::class, 'VorstandVerwalter']);

        //POST
        Route::post('/vorstand/add/vorstand', [AdminController::class, 'addVorstand']);
        Route::post('/vorstand/add/admin', [AdminController::class, 'addAdmin']);
        Route::post('/vorstand/del/vorstand', [AdminController::class, 'delVorstand']);
        Route::post('/vorstand/del/admin', [AdminController::class, 'delAdmin']);

        Route::post('/updateWebsitePart/{part}', [AdminController::class, 'updateWebsitePart'])->name('updateWebsitePart');
    });



Auth::routes();

