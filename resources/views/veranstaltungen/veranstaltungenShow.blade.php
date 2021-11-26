@extends('layouts.app')

@php
    $now = Carbon\Carbon::now();
@endphp

@section('content')
    <div class="row">
        <div class="col-12 col-lg-8">
            <h1>{{ $veranstaltung->titel }}</h1>
            <p>{!! $veranstaltung->beschreibung !!}</p>

            <!-- Anmeldung -->
            @auth
            @isset($anmeldung)
                <h3 class="mt-3">Deine Anmeldung</h3>
                <small>Angemeldet am: {{ $anmeldung->created_at->format('d.m.Y') }}</small>
                <p>Deine Bemerkung zur Anmeldung: {{ $anmeldung->bemerkungen }}</p>
                @foreach ( [ $anmeldung->pflicht_angaben , $anmeldung->freiwillige_angaben ] as $angaben_json )
                    {!! $loop->iteration == 1 ? '<h4 class="mt-3">Deine Pflichtangaben</h4>' : '' !!}
                    {!! $loop->iteration == 2 ? '<h4 class="mt-3">Deine freiwilligen Angaben</h4>' : '' !!}
                    @include('parts.displayDaten')
                @endforeach
            @endisset
            @endauth
            <!-- /Anmeldung -->
        </div>
        <div class="col-12 col-lg-4">
            <div class="card my-2">
                <div class="card-body">
                        <h5 class="card-title">Infos</h5>
                        <p>Verfügbare Plätze: {{ $verfuegbarePlaetze }}</p>
                    <hr>
                        <h4>Anmelden</h4>
                        <p class="card-text">Anmeldezeitraum: {{ date('d.m.Y',strtotime($veranstaltung->anmelde_start)) }} - {{ date('d.m.Y',strtotime($veranstaltung->anmelde_ende)) }}</p>
                        @auth
                            @if (
                                    // Interaktionsmöglichkeiten für Mitglieder
                                    in_array( 'member', json_decode($roles) )
                                    && $veranstaltung->anmelde_start <= date("Y-m-d H:i:s")
                                    && $veranstaltung->anmelde_ende >= date("Y-m-d H:i:s")
                                    && !isset($anmeldung)
                                )
                                <a href="/veranstaltungen/anmelden/{{$veranstaltung->id}}">
                                    <button class="btn btn-outline-success" >
                                        Anmelden
                                    </button>
                                </a>
                            @else
                                <button class="btn btn-outline-secondary disabled" >
                                    Du bist bereits angemeldet
                                </button>
                            @endif
                        @endauth
                        @guest
                            <a href="/login">
                                <button class="btn btn-outline-success" >
                                    Du musst dich erst einloggen
                                </button>
                            </a>
                        @endguest
                </div>
            </div>
            <div class="card my-2">
                <div class="card-body">
                    <h5 class="card-title">Ansprechpartner</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $ansprechpartner->firstname }} {{ $ansprechpartner->name }}</h6>
                    <p>m: <a href="mailto:{{ $ansprechpartner->email }}" class="card-link">{{ $ansprechpartner->email }}</a></p>
                    <p>t: <a href="tel:{{ $ansprechpartner->tel }}" class="card-link">{{ $ansprechpartner->tel }}</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
