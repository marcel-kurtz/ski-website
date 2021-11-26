@extends('layouts.app')

@section('content')
    @if(count($veranstaltungen) >0)
        <div class="mb-3 col">
            @foreach($veranstaltungen as $veranstaltung)
                <div class="row mx-1 my-2 border rounded-3 bg-white">
                    <div class="p-2 col-6 col-xl-1">
                        <p class="fw-bold">
                            {{ \Carbon\Carbon::parse($veranstaltung->start)->format('d.m.Y') }} - <br>
                            {{ \Carbon\Carbon::parse($veranstaltung->ende)->format('d.m.Y') }}
                        </p>
                    </div>
                    <div class="p-2 col-6 col-xl-5">
                        {{ $veranstaltung->titel }}<br>
                        <small class="fw-light">{!! $veranstaltung->beschreibung !!}</small>
                    </div>
                    <div class="p-2 col-6 col-xl-4 bg-opacity-10 bg-info">
                        @auth
                            Anmeldungstart: {{ \Carbon\Carbon::parse($veranstaltung->anmelde_start)->format('d.m.Y') }}<br>
                            Anmeldungende: {{ \Carbon\Carbon::parse($veranstaltung->anmelde_ende)->format('d.m.Y') }}<br>
                            Preis: {{ $veranstaltung->preis }}<br>

                            @if(Auth::user()->hasRole('member') && count($veranstaltung->teilnehmer) > 0)
                                <ul class="list-group">
                                    <p>
                                        <button class="btn btn-sm btn-outline-dark"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapseTeilnehmerListe_ID_{{$veranstaltung->id}}"
                                                aria-expanded="false"
                                                aria-controls="collapseTeilnehmerListe_ID_{{$veranstaltung->id}}">
                                            Bisherige Teilnehmer ansehen
                                        </button>
                                    </p>
                                    <ul class="collapse list-group list-group-flush bg-transparent" id="collapseTeilnehmerListe_ID_{{$veranstaltung->id}}">
                                        @foreach ($veranstaltung->teilnehmer as $teilnehmer)
                                            <li class="list-group-item bg-transparent">{{ $teilnehmer->vollerName }}</li>
                                        @endforeach
                                        @foreach ($veranstaltung->noneMembers as $externerTeilnehmer)
                                            <li class="list-group-item bg-transparent">{{ $externerTeilnehmer->Name }}</li>
                                        @endforeach
                                    </ul>
                                </ul>
                            @else
                                <p>
                                    <button class="btn btn-outline-dark"
                                            type="button"
                                            disabled>
                                        Bisher keine Teilnehmer
                                    </button>
                                </p>
                            @endif
                        @endauth
                        @guest
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Diese Informationen kannst du nur als Mitglied sehen</h6>
                                    <a href="{{ route('register') }}" class="btn btn-success card-link">jetzt Mitgleid werden</a>
                                </div>
                            </div>
                        @endguest
                    </div>
                    <div class="p-2 col-6 col-xl-2 bg-opacity-10 bg-info">
                        @auth
                            @if (count($veranstaltung->teilnehmer->where('id' , Auth::user()->id ) ) == 1)
                                <button disabled class="btn btn-success btn-lg">Du bis schon angemeldet</button>
                            @else
                                <a href="{{ route('Veranstaltung_anmelden', ['id' => $veranstaltung->id ]) }}" class="my-1 btn btn-success">
                                    Anmelden
                                </a>
                            @endif
                            @if(count($veranstaltung->dokumente) > 0)
                                <p>
                                    <button class="btn btn-sm btn-outline-dark"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseVeranstaltungDokumente_ID_{{$veranstaltung->id}}"
                                            aria-expanded="false"
                                            aria-controls="collapseVeranstaltungDokumente_ID_{{$veranstaltung->id}}">
                                        Dokumente zur Veranstaltung anzeigen
                                    </button>
                                </p>
                                <ul class="collapse list-group list-group-flush bg-transparent" id="collapseVeranstaltungDokumente_ID_{{$veranstaltung->id}}">
                                    @foreach ($veranstaltung->dokumente as $doc)
                                        <li class="list-group-item bg-transparent"><a target="_blank" href="{{ Storage::url($doc->path) }}">{{ $doc->name }}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                <p>
                                    <button class="btn btn-outline-dark"
                                            type="button"
                                            disabled>
                                        Bisher keine Dokumente
                                    </button>
                                </p>
                            @endif
                        @endauth
                        @guest
                            <a href="{{ route("register") }}">um an unseren Veranstaltungen teilzunehmen können, musst du bei uns Mitgleid sein. Die Mitgliedschaft bei dem besten Schneesport Club erhälst du hier.</a>
                        @endguest

                    </div>
                </div>
            @endforeach
            </div>
        </table>
    @endif
    @auth
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
    @endauth
    @guest
        <div class="card text-center my-5">
            <div class="card-body">
                <h2 class="card-title">Offenbar steht gerade nichts an</h2>
            </div>
            <div class="card-footer text-muted">
                Du musst dich leider noch etwas gedulden.
            </div>
        </div>
    @endguest
@endsection
