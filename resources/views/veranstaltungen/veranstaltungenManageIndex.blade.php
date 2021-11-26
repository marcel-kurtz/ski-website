@extends('layouts.app')

@section('content')
    <a class="btn btn-primary my-2" href="/veranstaltungsManagement/create">
        neue Veranstaltung</a>

    @if(count($veranstaltungen) >0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Informationen</th>
                <th scope="col">Daten</th>
                <th scope="col">Rahmenbedingungen</th>
                <th scope="col">Optionen</th>
            </tr>
        </thead>
        <tbody>
        @foreach($veranstaltungen as $veranstaltung)
        <tr><td colspan="5">
            <table class="table table-striped table-sm table-borderless">
            <tr>
                <td>{{ $veranstaltung->id }}</td>
                <td>
                    {{ $veranstaltung->titel }}<br>
                    <small>{!! $veranstaltung->beschreibung !!}</small>
                </td>
                <td>
                    Start: {{ \Carbon\Carbon::parse($veranstaltung->start)->format('d.m.Y') }}<br>
                    Ende: {{ \Carbon\Carbon::parse($veranstaltung->ende)->format('d.m.Y') }}<br>
                    Anmeldungstart: {{ \Carbon\Carbon::parse($veranstaltung->anmelde_start)->format('d.m.Y') }}<br>
                    Anmeldungende: {{ \Carbon\Carbon::parse($veranstaltung->anmelde_ende)->format('d.m.Y') }}
                </td>
                <td>
                    Preis: {{ $veranstaltung->preis }}<br>
                    Max. Teilnehmer: {{ $veranstaltung->max_teilnehmer }}<br>
                    Ansprechpartner: {{ $veranstaltung->ansprechpartner }}
                </td>
                <td>
                    <form method="post" action="veranstaltungsManagement/changeActiveStatus">
                        @csrf
                        <input type="hidden"
                               id="VeranstaltunsId"
                               name="VeranstaltunsId"
                               value="{{ $veranstaltung->id }}">
                        <button class="my-1 btn btn-primary" type="submit">
                        @if( $veranstaltung->active )
                            Deaktivieren
                        @else
                            Aktivieren
                        @endif
                        </button><br>
                    </form>
                    <form method="post" action="veranstaltungsManagement/deleteVeranstaltung">
                        @csrf
                        <input type="hidden"
                               id="VeranstaltunsId"
                               name="VeranstaltunsId"
                               value="{{ $veranstaltung->id }}">
                        <button class="my-1 btn btn-primary" type="submit">Löschen</button><br>
                    </form>
                    <button class="my-1 btn btn-primary"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#Veranstaltung{{$veranstaltung->id}}"
                            aria-expanded="true"
                            aria-controls="Veranstaltung{{$veranstaltung->id}}"
                            disabled>
                        Mehr
                    </button>
                </td>
            </tr>
            <tr class="collapse.show" id="#Veranstaltung{{$veranstaltung->id}}">
                <td colspan="2">
                    {{-- Teilnehmer --}}
                    @if(!count($veranstaltung->teilnehmer)==0)
                    <h5>Teilnehmer</h5>
                    <ul class="list-group">
                        @foreach($veranstaltung->teilnehmer as $teilnehmer)
                        <li class="list-group-item">{{ $teilnehmer->vollerName }}</li>
                        @endforeach
                    </ul>
                    @endif
                    @if(!count($veranstaltung->noneMembers)==0)
                    <h5>Teilnehmer ohne Mitgliedschaft</h5>
                    <ul class="list-group">
                        @foreach($veranstaltung->noneMembers as $nonmember)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>{{ $nonmember->Name }}</div>
                                    <div>
                                        <form action="{{ route('Veranstaltung_Nichtmitglied_loeschen') }}" method="POST">
                                            @csrf
                                            <input type="hidden" id="id" name="id" value="{{ $nonmember->id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">löschen</button>
                                        </form>
                                    </div>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                    @endif
                </td>
                <td>
                    @if(!count($veranstaltung->dokumente) == 0)
                    <h5>Dateien</h5>
                    <ul class="list-group">
                    @foreach($veranstaltung->dokumente->sortBy('name') as $dokument)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <a target="_blank" href="{{ Storage::url($dokument->path) }}">{{ $dokument->name }}</a>
                                </div>
                                <form action="{{ route('Veranstaltung_deleteFile') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="documentId" name="documentId" value="{{ $dokument->id }}">
                                    <button class="btn btn-danger">löschen</button>
                                </form>
                            </li>
                    @endforeach
                    </ul>
                    @endif
                </td>
                <td>
                    Erstelle: {{ \Carbon\Carbon::parse($veranstaltung->created_at)->format('d.m.Y') }}<br>
                    Bearbeitet: {{ \Carbon\Carbon::parse($veranstaltung->updated_at)->format('d.m.Y') }}<br>
                </td>
                <td>
                    <a href="{{ route('manageVeranstaltungShow',['id' => $veranstaltung->id]) }}">
                        <button class="my-1 btn btn-success"
                                type="submit">
                            Bearbeiten
                        </button>
                    </a><br>
                    <a href="{{ route('Veranstaltung_addFile_show',['veranstaltungsId' => $veranstaltung->id]) }}">
                        <button class="my-1 btn btn-success"
                                type="submit">
                            Datei Hinzufügen
                        </button>
                    </a><br>
                    <a href="{{ route('Veranstaltung_Nichtmitglied_hinzufuegen',['veranstaltungsId' => $veranstaltung->id]) }}">
                        <button class="my-1 btn btn-success"
                                type="submit">
                            Nichtmitglied Hinzufügen
                        </button>
                    </a>
                </td>
            </tr>
            @if ( Auth::user()->hasRole('admin') )
            <tr>
                <td colspan="5">

                        {{ $veranstaltung->pflicht_angaben }}
                        {{ $veranstaltung->freiwillige_angaben }}
                </td>
            </tr>
            @endif
            </table>
        </td></tr>
        @endforeach


        </tbody>
    </table>
    @endif
    @if(count($veranstaltungen) === 0)
        <div class="card text-center my-5">
            <div class="card-body">
                <h2 class="card-title">Du musst erst eine Veranstaltung erstellen</h2>
            </div>
            <div class="card-footer text-muted">
                <a class="btn btn-primary my-2" href="/veranstaltungsManagement/create">Jetzt neue Veranstaltung</a>
            </div>
        </div>
    @endif
@endsection
