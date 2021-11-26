<?php

namespace App\Http\Controllers;

use App\Models\Models\dokumente;
use App\Models\NoneMembers;
use App\Models\User;
use App\Models\Veranstaltung;
use App\Models\VeranstaltungDokumentMapping;
use Illuminate\Http\Request;
use App\Repository\VeranstaltungsRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\VeranstaltungTeilnahme;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;


class VeranstaltungsController extends Controller
{
    public function __construct()
    {
        $this->VeranstaltungRequestValidateArray = [
            "id" => ['exists:App\Models\Veranstaltung,id'],
            "anmelde_start" => ['required','before:anmelde_ende'],
            "anmelde_ende" => ['required','before:start'],
            "start" => ['required','before:ende'],
            "ende" => ['required'],
            // "active" => ['accepted'],
            // "ansprechpartner" => ['required','exists:users,id'],
            "preis" => ['required','numeric'],
            "max_teilnehmer" => ['required','Integer'],
            "beschreibung" => ['required','nullable','string'],
            "titel" => ['required','string'],
            // "pflicht_angaben" => ['json','nullable'],
            // "freiwillige_angaben" => ['json','nullable'],
        ];
    }

    //******************************//
    //      CRUD operations for     //
    //      Veranstaltungen         //
    //******************************//

    /**
     *  Creates Veranstaltung, or updates, if veranstaltung already exists
     */
    public function createOrUpdate(Request $request) : Veranstaltung {
        // validate input
        $validatedRequest = $request->validate($this->VeranstaltungRequestValidateArray);
        // Wenn active gesetzt ist, ist der harken aktiviert, und die Veranstaltung ist direkt live.
        // Andernfalls wird die Veranstaltung auf inaktiv gesetzt
        $validatedRequest['active'] = (isset($validatedRequest['active']))? true : false;
        //erstellen der Veranstaltung
        $veranstaltung = Veranstaltung::updateOrCreate($validatedRequest);
        $veranstaltung->save();
        return $veranstaltung;
    }
    /**
     *  update
     */
    public function update(Request $request) : Veranstaltung {
        // validate input
        $validatedRequest = $request->validate($this->VeranstaltungRequestValidateArray);

        // Wenn active gesetzt ist, ist der harken aktiviert, und die Veranstaltung ist direkt live.
        // Andernfalls wird die Veranstaltung auf inaktiv gesetzt
        $validatedRequest['active'] = (isset($validatedRequest['active']))? true : false;

        //erstellen der Veranstaltung
        $veranstaltung = Veranstaltung::updateOrCreate(
            ['id'=> $validatedRequest['id']],
            $validatedRequest
        );
        $veranstaltung->save();
        return $veranstaltung;
    }
    /**
     *  Read
     */
    public function read(int $id = null ) : Collection {
        // if $id == null, return all
        if (is_null($id)) return Veranstaltung::all();
        // else only return by ID
        return Veranstaltung::find($id);
    }

    /**
     *  Delete
     */
    public function delete($id) : bool {
        $res= Veranstaltung::find($id)->delete();
        return $res;
    }

    //******************************//
    //          Methods             //
    //                              //
    //******************************//

    /**
     *
     */
    public function index()
    {
        $veranstaltungen = Veranstaltung::all() ;
        return view('veranstaltungen.veranstaltungenIndex')
            ->with('veranstaltungen',$veranstaltungen);
    }

    /**
     *
     */
    public function show($id)
    {
        $veranstaltung = $this->repository->getById($id) ;
        $verfuegbarePlaetze = $this->repository->verfuegbarePlaetze($veranstaltung);

        $view = view('veranstaltungen.veranstaltungenShow')
            ->with('veranstaltung',$veranstaltung)
            ->with('verfuegbarePlaetze',$verfuegbarePlaetze)
            ->with( 'ansprechpartner' , $veranstaltung->getAnsprechpartner );

        // json objekt für Vue Component
        if ( Auth::check() ) $view->with('anmeldung',$veranstaltung->teilnahmen->where('id' , Auth::user()->id )->where('veranstaltung' , $id )->first() );

        return $view;
    }

    /**
     *
     */
    public function anmelden($id)
    {
        $veranstaltung = Veranstaltung::find($id);

        log::info($veranstaltung->teilnehmer->where('id',Auth::user()->id));
        log::info($veranstaltung->max_teilnehmer);
        log::info( count($veranstaltung->teilnehmer) );
        log::info($veranstaltung->ansprechpartner);

        // wenn eine Anmeldung existiert, oder anmeldungen >= maxTeilnehmer anzahl ist -> back();
        if (
            count($veranstaltung->teilnehmer->where('id',Auth::user()->id) ) > 0 ||
            $veranstaltung->max_teilnehmer <= count($veranstaltung->teilnehmer)
           )
        {
            return back();
        }
        return view('veranstaltungen.veranstaltungenAnmelden')
            ->with('veranstaltung', $veranstaltung);
    }

    /**
     *
     */
    public function anmeldenSubmit( Request $request, $id )
    {
        $veranstaltungsId = $id;
        // check submit
        $validation = true;
        // validate if agb is turned on
        if( $request->agb == 'on' ) {
            $validation = true && $validation;
        }
        else {
            $validation = false;
        }
        // validate if every entry with an json value has its counterpart
        $objectKeys = [];
        foreach ($request->input() as $key => $value) {
            log::info('$request->input()['.$key.'] : '.json_encode( $request->input()[$key] ));
            if ( array_key_exists( $key.'_original',$request->input()) ) {
                array_push($objectKeys,$key);
            }
        }
        log::info('json_encode($objectKeys) : '.json_encode($objectKeys));

        // merge _originals and input
        $resultArrays = [];
        foreach ( $objectKeys as $object ) {

            // TODO check if datatypes work to avoid errors
            $resultArrays[ $object.'_original' ] = (array) json_decode( $request->input()[ $object.'_original' ] , true);
            $resultArrays[ $object ] = (array) $request->input()[ $object ] ;

            // make input part of _original array and save _original+input array in $resultArrays
            foreach ( $resultArrays[ $object ] as $key => $value) {
                $type = $resultArrays[ $object.'_original' ][$key]['type'];
                $resultArrays[ $object.'_original' ][$key][$type] = $value;
            }
            $resultArrays[ $object ] =$resultArrays[ $object.'_original' ];
            array_except( $resultArrays , $object.'_original' );

        }

        // create entry
        $teilnahme= VeranstaltungTeilnahme::create([
            'veranstaltung' => $veranstaltungsId ,
            'pflicht_angaben' => json_encode($resultArrays[ 'pflicht_angaben' ]) ,
            'freiwillige_angaben' => json_encode($resultArrays[ 'freiwillige_angaben' ]) ,
            'teilnehmer' => Auth::user()->id ,
            'bemerkungen' => $request->bemerkungen ,
        ]);
        $teilnahme->save();

        // return
        return redirect( '/veranstaltungen/show/'.$veranstaltungsId );
    }

    /**
     *
     */
    public function manageNewVeranstaltung() {
        $ansprechpartner = User::whereHas('roles', function ($query) {
            $query->where('name', 'veranstalter');
        })->get();
        return view('veranstaltungen.veranstaltungenManageNew')
            ->with('mitglieder',$ansprechpartner);
    }

    /**
     *
     */
    public function manageCreate(Request $request) {
        // $result = $request->validate($this->VeranstaltungRequestValidateArray);
        log::info($request);

        $model = Veranstaltung::updateOrCreate([
            'id' => $request->id
        ],[
            'start' => $request->start,
            'ende' => $request->ende,
            'anmelde_start' => $request->anmelde_start,
            'anmelde_ende' => $request->anmelde_ende,
            'active' => isset($request->active) ,
            'ansprechpartner' => $request->ansprechpartner,
            'preis' => $request->preis,
            'max_teilnehmer' =>$request->max_teilnehmer,
            'beschreibung' => $request->beschreibung,
            'titel' => $request->titel
        ]);

        if(isset($request->id)) {
            $messageString = 'Veranstaltung'. $model->title .'wurde aktualisiert';
        } else {
            $messageString = 'Veranstaltung'. $model->title .'angelegt';
        }

        return redirect()->route('veranstaltung_manage_index')->with('SuccessMessage', $messageString);
    }

    /**
     * Zeigt alle Veranstaltungen an
     */
    public function manageIndex() {
        $veranstaltungen = Veranstaltung::orderBy("id")->get();
        $ansprechpartner = User::all();
        return view('veranstaltungen.veranstaltungenManageIndex')
            ->with('veranstaltungen',$veranstaltungen);
    }

    /**
     * Zeigt eine einzeige Veranstaltung an
     */
    public function manageShow($id) {
        $veranstaltung = Veranstaltung::find($id);
        $ansprechpartner = User::all();
        return view('veranstaltungen.veranstaltungenManageShow')
            ->with('veranstaltung',$veranstaltung)
            ->with('ansprechpartner',$ansprechpartner);
    }

    /**
     * Ändert den Zustand von active (bool)
     */
    public function manageChangeActiveStatus(Request $request) {
        $id = $request->VeranstaltunsId;
        $veranstaltung = Veranstaltung::find($id);
        // Change activity status
        $veranstaltung->active = !$veranstaltung->active;
        $veranstaltung->save();
        // redirect back, with message, which is the new status of the Veranstaltung
        $messageString = "Veranstaltung" . $veranstaltung->titel . "wurde auf" . ($veranstaltung->active ? "true": "false") . "geändert" ;
        return back()->with('ChangeActiveStatus', $messageString );
    }

    /**
     * Löscht eine Veranstaltung
     */
    public function manageDeleteVeranstaltung(Request $request) {
        $id = $request->VeranstaltunsId;
        if($this->delete($id)) {
            // go back with emssage
            $messageString = "Veranstaltung" . $id . "wurde gelöscht";
            return back()->with('DeletedVeranstaltungStatus', $messageString );
        }
        return back()->with('errorMessage','Löschen nicht möglich');
    }

    /**
     * Save file
     */
    public function saveFile(Request $request, $veranstaltungsId){
        // speichern von Datei
        $uniqueID = "test" ;
        $filename = "test" ;
        $path = "VeranstaltunsFiles/" . $uniqueID . $filename;
        Storage::put( );

        // speichern in datenbank
        $veranstaltung = Veranstaltung::find($veranstaltungsId);
        $veranstaltung->dokumente()->create([
            'path' => $path,
            'type' => '',
        ]);
    }

    public function showAddFile($veranstaltungsId) {
        // get all files
        $veranstalung = Veranstaltung::find($veranstaltungsId);
        $dokumente = $veranstalung->dokumente;
        // return view with file info
        log::info($veranstalung);
        log::info($dokumente);
        return view('veranstaltungen.veranstaltungenMamageFileupload')
            ->with('veranstalung',$veranstalung)
            ->with('dokumente',$dokumente);
    }

    public function AddFile($veranstaltungsId, Request $request) {
        $path = Storage::disk('public')->putFile('documents', $request->file('FileToUpload'));
        // add file to storage
        $veranstaltung = Veranstaltung::find($veranstaltungsId);
        $dokument = $veranstaltung->dokumente()->create([
            'type' => $request->file('FileToUpload')->getClientOriginalExtension() ,
            'path' => $path,
            'veranstaltung',
            'dokument',
            'name' => $request->documentName,
        ]);
        $mapping = new VeranstaltungDokumentMapping([
            'veranstaltung' => $veranstaltung->id,
            'dokument' => $dokument->id
        ]);
        $mapping->save();
        return redirect(route('veranstaltung_manage_index'));
    }

    /**
     * Löscht Dokument und Verbindung, sobald das Dokument erforgreich aus dem Filesystem gelöscht wurde
     * Nach erfolgriecher physischer löschung werden auch die Datenbankeinträge gelöscht
     *
     * @param Request $request
     * @return redirect
     */
    public function DeleteFile(Request $request) {
        // get document information
        $dokument = dokumente::find($request->documentId);
        log::info($dokument);
        // delete file from Storage
        if(Storage::disk('public')->delete($dokument->path)) {
            // delete attachment of document and veranstalung
            $veranstaltungsmapping = VeranstaltungDokumentMapping::where('dokument',$request->documentId)->get();
            foreach ($veranstaltungsmapping as $entry){
                $entry->delete();
            }
            // delete record of document
            $dokument->delete();
        } else {
            return back();
        }
        return redirect(route('veranstaltung_manage_index'));
    }


    /**
     * Einen Teilnehmer hinzufügen, der nicht Mitglied im Verein ist
     */
    public function NichtmitgliedAdd($id, Request $request) {
        $veranstaltung = Veranstaltung::find($id);
        return view('veranstaltungen.veranstaltungenNichtmitgliedHinzufügen')
            ->with("veranstaltung",$veranstaltung);
    }

    public function SubmitNichtmitgliedAdd(Request $request) {
        $Name = $request->Name ;
        $email = $request->email ;
        $veranstaltung = $request->veranstaltung ;

        $nonmember = new NoneMembers();
        $nonmember->Name = $Name;
        $nonmember->email = $email;
        $nonmember->veranstaltung = $veranstaltung;
        $nonmember->user_id = Auth::user()->id;

        $nonmember->save();
        return redirect(route('veranstaltung_manage_index'));
    }
    public function NichtmitgliedDelete(Request $request) {
        $id = $request->id;
        $nonmember = NoneMembers::find($id);
        $nonmember->delete();

        return redirect(route('veranstaltung_manage_index'));
    }


}
