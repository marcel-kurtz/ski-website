
@extends('layouts.app')

@php
    $now = Carbon\Carbon::now();
@endphp

@section('content')
    <div class="row">
        <div class="col-12 col-lg-8">
            <h1>{{$veranstaltung->titel}}</h1>
            <p>{!! $veranstaltung->beschreibung !!}</p>
            {{ $veranstaltung->ansprechpartner }}
            <hr>
            <form method="post" action="/veranstaltungen/anmelden/{{ $veranstaltung->id }}/submit">
                @csrf
                @foreach ( [ 'pflicht_angaben' => $veranstaltung->pflicht_angaben , 'freiwillige_angaben' => $veranstaltung->freiwillige_angaben ] as $key => $angaben_json )
                    {{ $key == 'pflicht_angaben' ? $required='required' : $required='' }}
                    {!! $loop->iteration == 1 ? '<h2>Pflichtangaben</h2>' : '' !!}
                    {!! $loop->iteration == 2 ? '<h2>Freiwillige Angaben</h2>' : '' !!}
                    @if (App::environment('local'))
                        key:{{ $key }}<br>
                        json:{{ $angaben_json }}
                    @endif
                    @include('parts.eingabeDaten')
                @endforeach

                <div class="form-group">
                    <label for="Bemerkungen">Bemerkungen</label>
                    <textarea class="form-control" id="Bemerkungen" name="bemerkungen" rows="3"></textarea>
                </div>

                <div class="input-group mb-3">
                    <input type="checkbox" name="agb" required aria-label="Mit der Anmeldung akzeptiere ich die <a href='/agb'>AGBs</a> com SSC Lüneburg">
                    <label for="agb" class="ml-3 align-text-top">Mit der Anmeldung akzeptiere ich die <a href='/agb'>AGBs</a> com SSC Lüneburg</label>
                </div>
                <button class="btn btn-outline-success text-uppercase" type="submit">anmelden</button>
            </form>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card my-2">
                <div class="card-body">
                    <h5 class="card-title">Ansprechpartner</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $veranstaltung->ansprechpartner->firstname }} {{ $veranstaltung->ansprechpartner->name }}</h6>
                    <p class="my-0">m: <a href="mailto:{{ $veranstaltung->ansprechpartner->email }}" class="card-link">{{ $veranstaltung->ansprechpartner->email }}</a></p>
                    <p class="my-0">t: <a href="tel:{{ $veranstaltung->ansprechpartner->tel }}" class="card-link">{{ $veranstaltung->ansprechpartner->tel }}</a></p>
                </div>
            </div>
        </div>
@endsection
