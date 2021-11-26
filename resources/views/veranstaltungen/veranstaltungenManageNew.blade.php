@extends('layouts.app')

@section('content')
    <form action="{{ route('veranstaltung_manage_create_post') }}" method="POST" >
    @csrf
        <div class="col ">
            <div class="row mb-2 pb-1 border-bottom">
                <div class="col-md-4 col-12">
                    <label for="titel" class="form-label">Titel der Veranstaltung</label>
                    <input required type="text" class="form-control" name="titel" id="titel">
                </div>
                <div class="col-md-4 col-12">
                    <label for="beschreibung" class="form-label">Beschreibung der Veranstaltung</label>
                    <textarea required class="form-control" name="beschreibung" id="beschreibung" rows="3"></textarea>
                </div>
            </div>
            <div class="row mb-2 pb-1 border-bottom">
                <div class="col-md-4 col-12">
                    <label for="start">Start der Veranstaltung</label>
                    <input required name="start" id="start" type="datetime-local" class="form-control col">
                </div>
                <div class="col-md-4 col-12">
                    <label for="ende">Ende der Veranstaltung</label>
                    <input required name="ende" id="ende" type="datetime-local" class="form-control">
                </div>
            </div>
            <div class="row mb-2 pb-1 border-bottom">
                <div class="col-md-4 col-12">
                    <label for="anmelde_start">Start der Anmeldung</label>
                    <input required name="anmelde_start" id="anmelde_start" type="datetime-local" class="form-control col">
                </div>
                <div class="col-md-4 col-12">
                    <label for="anmelde_ende">Ende der Anmeldung</label>
                    <input required name="anmelde_ende" id="anmelde_ende" type="datetime-local" class="form-control">
                </div>
            </div>
            <div class="row mb-2 pb-1 border-bottom">
                <div class="col-md-4 col-12">
                    <div class="form-check ">
                        <input class="form-check-input"
                               type="checkbox"
                               style="transform: scale(1.2);"
                               name="active" id="active">
                        <label class="form-check-label" for="active">
                            Soll die Veranstaltung direkt nach erstellen sichtbar sein?
                        </label>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <label for="ansprechpartner">Wer soll Ansprechpartner für die Veranstaltung sein</label>
                    <select class="custom-select custom-select-lg mb-2 col-12" aria-label=".form-select-lg example" name="ansprechpartner" id="ansprechpartner">
                        <option disabled>Wähle einen Verantwortlichen aus</option>
                        @foreach($mitglieder as $verantwortlicher)
                            <option value="{{ $verantwortlicher->id }}">{{ $verantwortlicher->vollerName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 col-12">
                    <label for="preis">Preis für die Veranstalung</label>
                    <div class="input-group mb-3">
                        <input required name="preis" id="preis" type="number" class="form-control col">
                        <span class="input-group-text">€</span>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <label for="max_teilnehmer">Maximale Anzahl an Teilnehmenden</label>
                    <input required name="max_teilnehmer" id="max_teilnehmer" type="number" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 col-12">
                    <button type="submit" class="btn bg-success">Veranstaltung anlegen</button>
                </div>
            </div>
        </div>
    </form>
@endsection





