<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
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
        $lizenzen = DB::table('lizenzen')
            ->where('user', Auth::user()->id)
            ->get();
        
        return view('Mitgliederbereich.pages.home')
            ->with( 'lizenzen' , $lizenzen );
    }

    public function myLizenz()
    {
        $lizenzdaten = DB::table('lizenzen')
            ->where('user', '=', Auth::user()->id )
            ->orderByDesc('erhalten')
            ->get();
        
        Log::info($lizenzdaten);
        return view('Mitgliederbereich.pages.lizenzen')
            ->with('lizenzdaten', $lizenzdaten);
    }

    public function myData()
    {
        $personendaten = DB::table('users')
            ->where( 'id' , '=', Auth::user()->id )
            ->first();
        
        return view('Mitgliederbereich.pages.meineDaten')
            ->with('personendaten', $personendaten);
    }

    // POST Methoden
    /**
     * TODO Alert korrekt implementieren
     */
    public function updateDaten(Request $request) {
        //erfolg der Update-Vorganges
        $user = Auth::user();
        $user->firstname = $request->input('firstname');
        $user->name = $request->input('name');
        $user->tel = $request->input('tel');

        $user->strasse = $request->input('strasse');
        $user->plz = $request->input('plz');
        $user->ort = $request->input('ort');

        $user->save();
        Log::info('nutzerdaten gespeichert');
        return redirect('member/myData')
        ->with(['alert' => 'Daten hochgeladen!']);
        
    }

    /**
     * TODO Alert korrekt implementieren
     */
    public function updatePassword(Request $request) {
        //erfolg der Update-Vorganges
        $user = Auth::user();
        if (
            Hash::check($request->input('altesPasswort') , $user->password ) && 
            $request->input('neuesPasswort') == $request->input('neuesPasswortWdhl')
            ) 
            {
            $user->password = Hash::make($request->input('neuesPasswort'));
            $user->save();

            return redirect('member/myData')
                ->with(['alert' => 'Passwort upgedated!']);
        } else {
            return redirect('member/myData')
                ->with(['alert' => 'Password erneuerung fehlgeschlagen!']);
        }
    }

    public function updateLizenz(Request $request) {
        DB::table('lizenzen')
            ->where('id' , $request->input('lizenzId'))
            ->update([
                'disziplin' => $request->input('disziplin') ,
                'verband' => $request->input('verband') ,
                'niveau' => $request->input('niveau') ,
                'erhalten' => $request->input('erhalten') ,
                'letzteFortbilung' => $request->input('letzteFortbilung') ,
                'letzteFortbilungNummer' => $request->input('letzteFortbilungNummer') ,
                'letzteFortbilungTage' => $request->input('letzteFortbilungTage') ,
                'letzterErsteHilfeKurs' => $request->input('letzterErsteHilfeKurs') ,
            ]);
        return redirect('/member/myLizenz')
            ->with(['alert' => 'Lizenz gespeichert!']);
    }
    public function deleteLizenz(Request $request) {
        DB::table('lizenzen')
            ->where('id' , $request->input('lizenzId'))
            ->delete();
        return redirect('/member/myLizenz')
            ->with(['alert' => 'Lizenz gelöscht!']);
    }

    public function addLizenz(Request $request) {
        DB::table('lizenzen')
            ->insert([
                'user' => Auth::user()->id ,
                'disziplin' => $request->input('disziplin') ,
                'verband' => $request->input('verband') ,
                'niveau' => $request->input('niveau') ,
                'erhalten' => $request->input('erhalten') ,
                'letzteFortbilung' => $request->input('letzteFortbilung') ,
                'letzteFortbilungNummer' => $request->input('letzteFortbilungNummer') ,
                'letzteFortbilungTage' => $request->input('letzteFortbilungTage') ,
                'letzterErsteHilfeKurs' => $request->input('letzterErsteHilfeKurs') ,
            ]);
        return redirect('/member/myLizenz')
            ->with(['alert' => 'Lizenz Hinzugefügt!']);
    }

}
