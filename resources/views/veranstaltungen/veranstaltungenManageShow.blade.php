@extends('layouts.app')

@section('content')
@if (Auth::user()->hasRole('admin'))
    @json($veranstaltung)
@endif
    <form action="{{ route('veranstaltung_manage_create_post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $veranstaltung->id }}">
        <div class="col ">
            <div class="row mb-2 pb-1 border-bottom">
                <div class="col-md-4 col-12">
                    <label for="titel" class="form-label">Titel der Veranstaltung</label>
                    <input required type="text" class="form-control" name="titel" id="titel" value="{{ $veranstaltung->titel }}">
                </div>
                <div class="col-md-4 col-12">
                    <label for="beschreibung" class="form-label">Beschreibung der Veranstaltung</label>
                    <textarea class="form-control" name="beschreibung" id="beschreibung" rows="3">{{ $veranstaltung->beschreibung }}</textarea>
                </div>
            </div>
            <div class="row mb-2 pb-1 border-bottom">
                <div class="col-md-4 col-12">
                    <label for="start">Start der Veranstaltung</label>
                    <input required name="start" id="start" type="datetime-local" class="form-control col" value="{{ $veranstaltung->start->format('yyyy-mm-DThh:mm') }}">
                </div>
                <div class="col-md-4 col-12">
                    <label for="ende">Ende der Veranstaltung</label>
                    <input required name="ende" id="ende" type="datetime-local" class="form-control" value="{{ $veranstaltung->ende }}">
                </div>
            </div>
            <div class="row mb-2 pb-1 border-bottom">
                <div class="col-md-4 col-12">
                    <label for="anmelde_start">Start der Anmeldung</label>
                    <input required name="anmelde_start" id="anmelde_start" type="datetime-local" class="form-control col" value="{{ $veranstaltung->anmelde_start }}">
                </div>
                <div class="col-md-4 col-12">
                    <label for="anmelde_ende">Ende der Anmeldung</label>
                    <input required name="anmelde_ende" id="anmelde_ende" type="datetime-local" class="form-control" value="{{ $veranstaltung->anmelde_ende }}">
                </div>
            </div>
            <div class="row mb-2 pb-1 border-bottom">
                <div class="col-md-4 col-12">
                    <div class="form-check ">
                        <input class="form-check-input"
                               type="checkbox"
                               style="transform: scale(1.2);"
                               name="active"
                               id="active"
                               @if($veranstaltung->active) checked @endif>
                        <label class="form-check-label" for="active">
                            Soll die Veranstaltung direkt nach erstellen sichtbar sein?
                        </label>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <label for="ansprechpartner">Wer soll Ansprechpartner für die Veranstaltung sein</label>
                    <select required class="custom-select custom-select-lg mb-2 col-12" aria-label=".form-select-lg example" name="ansprechpartner" id="ansprechpartner">
                        @foreach($ansprechpartner as $verantwortlicher)
                            <option
                                    value="{{ $verantwortlicher->id }}"
                                    @if ($verantwortlicher->id == $veranstaltung->ansprechpartner) selected @endif>
                                {{ $verantwortlicher->vollerName }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 col-12">
                    <label for="preis">Preis für die Veranstalung</label>
                    <div class="input-group mb-3">
                        <input required
                               name="preis"
                               id="preis"
                               type="number"
                               class="form-control col"
                               value="{{ $veranstaltung->preis }}">
                        <span class="input-group-text">€</span>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <label for="max_teilnehmer">Maximale Anzahl an Teilnehmenden</label>
                    <input required
                           name="max_teilnehmer"
                           id="max_teilnehmer"
                           type="number"
                           class="form-control"
                           value="{{ $veranstaltung->max_teilnehmer }}">
                </div>
            </div>
            <div class="row mb-3">
                <input type="file" class="" id="AusschreibungFile">
                <div class="col-md-4 col-12">
                    <label for="AusschreibungFile">Ausschreibung hochladen</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">

                            <label class="custom-file-label" for="AusschreibungFile">Choose file</label>
                        </div>
                    </div>
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
