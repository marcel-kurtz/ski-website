<?php

namespace App\Http\Controllers;

use App\Models\Beitrag;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BeitragsController extends Controller
{
    public function index () {
        $beitraege = $beitraege = Beitrag::all();
        $authoren = User::whereRelation('roles','name', 'author')->get();
        $potentielleAuthoren = User::all()->diff($authoren);
        return view('beitraege.pages.index')
            ->with('beitraege',$beitraege)
            ->with('authoren',$authoren)
            ->with('potentielleAuthoren',$potentielleAuthoren);
    }
    public function edit ($id) {
        $beitrag = ($beitrag = Beitrag::find($id)) ? $beitrag : new Beitrag ;
        return view('beitraege.pages.edit')
            ->with('beitrag',$beitrag);
    }

    //**********************//
    //         POST         //
    //**********************//
    public function save ($id, Request $request) {
        if(isset($request->id)){
            Beitrag::updated($request);
        } else {
            Beitrag::create($request);
        }
        return redirect(route('AuthorIndex'));
    }
    public function delete ($id, Request $request) {
        $model = Beitrag::find($id);
        $model->delete();
        return redirect(route('AuthorIndex'));
    }
    public function addAuthor (Request $request) {
        $user = User::find($request->UserToAdd);
        $user->roles()->attach(UserRoles::where('name','author')->first()->id);
        return redirect(route('AuthorIndex'));
    }
    public function deleteAutor (Request $request) {
        $user = User::find($request->id);
        // check if last author

        //delete relation
        $user->roles()->detach(UserRoles::where('name','author')->first()->id);
        return redirect(route('AuthorIndex'));
    }
}
