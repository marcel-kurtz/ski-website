@extends('Mitgliederbereich.layout')

@section('content')
    <h1>Deine Daten</h1>
    <hr>
    <section name="PersoenlicheDaten" class="m-3 col-12 col-md-7">
        <h2>Persönliche Daten</h2>
        <form method="POST" action="/member/myData" class="row">
        @csrf
            <div class="form-group col-12">
                <label for="email">E-Mail</label>
                <input disabled class="form-control" type="text" name="email" id="email" placeholder="E-Mail" value="{{ $personendaten->email ?? '' }}"> 
            </div>
            <div class="form-group col-6">
                <label for="firstname">Vorname</label>
                <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Vorname" value="{{ $personendaten->firstname ?? '' }}"> 
            </div> 
            <div class="form-group col-6">
                <label for="name">Nachname</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="Nachname" value="{{ $personendaten->name ?? '' }}">
            </div> 
            <div class="form-group col-6">
                <label for="tel">Telefon</label>
                <input class="form-control" type="text" name="tel" id="tel" placeholder="Telefon" value="{{ $personendaten->tel ?? '' }}">
            </div> 
            <div class="form-group col-4">
                <label for="birthdate">Geburtstag</label>
                <input disabled class="form-control" type="date" name="birthdate" id="Geburtstag" placeholder="birthdate" value="{{ $personendaten->birthdate ?? '' }}">
            </div> 
            <div class="form-group col-12">
                <label for="strasse">Straße</label>
                <input class="form-control" type="text" name="strasse" id="strasse" placeholder="Straße" value="{{ $personendaten->strasse ?? '' }}"> 
            </div> 
            <div class="form-group col-6">
                <label for="plz">PLZ</label>
                <input class="form-control" type="text" name="plz" id="plz" placeholder="PLZ" value="{{ $personendaten->plz ?? '' }}"> 
            </div> 
            <div class="form-group col-6">
                <label for="ort">Ort</label>
                <input class="form-control" type="text" name="ort" id="ort" placeholder="Ort" value="{{ $personendaten->ort ?? '' }}"> 
            </div>
            <div class="form-group col-7">
                <button class="btn btn-secondary" type="submit">speichern</button>
            </div>        
        </form>
    </section>
    <hr>
    <section name="PasswortReset" class="m-3 col-12 col-md-7">
        <h2>Passwort</h2>
        <form method="POST" action="/member/myData/password" class="row">
        @csrf
            <div class="form-group col-7">
                <label for="ort">altes Passwort</label>
                <input class="form-control" type="password" name="altesPasswort" id="altesPasswort" placeholder="altes Passwort" > 
            </div>
            <div class="form-group col-7">
                <label for="ort">neues Passwort</label>
                <input class="form-control" type="password" name="neuesPasswort" id="neuesPasswort" placeholder="neues Passwort" > 
            </div>
            <div class="form-group col-7">
                <label for="ort">neues Passwort wiederholen</label>
                <input class="form-control" type="password" name="neuesPasswortWdhl" id="neuesPasswortWdhl" placeholder="neues Passwort wiederholen" > 
            </div>
            
            <div class="form-group col-7">
                <button class="btn btn-secondary" type="submit">speichern</button>
            </div>
        </form>
    </section>
    
@endsection