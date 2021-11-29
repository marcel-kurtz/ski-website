@extends('beitraege.layout')

@section('content')
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Beschreibung</th>
        <th scope="col" style="width: 100%">Vorschau</th>
        <th scope="col">Status</th>
        <th scope="col">Aktionen</th>
    </tr>
    </thead>
    <tbody>
    @foreach($beitraege as $beitrag)
    <tr>
        <th scope="row">{{ $beitrag->id }}</th>
        <td>
            {{ $beitrag->name }}<br>
            <small>{{ $beitrag->beschreibung }}</small>
        </td>
        <td>
            <p>
                <button class="btn btn-primary"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseBeitragVorschau_ID_{{ $beitrag->id }}"
                        aria-expanded="false"
                        aria-controls="collapseBeitragVorschau_ID_{{ $beitrag->id }}">
                    Vorschau anzeigen
                </button>
            </p>
            <div class=" collapse" id="collapseBeitragVorschau_ID_{{ $beitrag->id }}">
                <div class="card card-body">
                    {!! $beitrag->html !!}
                </div>
            </div>
        </td>
        <th scope="row">@if($beitrag->aktiv == 'true') Aktiv @else Offline @endif</th>
        <td class="row">
            <div class="row">
                <div>
                    <a class="my-1 btn btn-outline-success" href="{{ route('AuthorEdit', ['id' => $beitrag->id]) }}">
                        bearbeiten
                    </a>
                </div>
                <div>
                    <a class="my-1 btn btn-danger" href="{{ route('AuthorEdit', ['id' => $beitrag->id]) }}">
                        löschen
                    </a>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>


@if(Auth::user()->hasRole('admin'))
    <h2>Authoren Bearbeiten</h2>
    <div class="card my-3">
        <div class="card-header">
            <h4>Hinzufügen</h4>
        </div>
        <div class="card-body">
        @if(count($potentielleAuthoren)>0)
            <form method="POST" action="{{ route('AuthorAddAuthor') }}">
                @csrf
                <select class="form-select" name="UserToAdd" id="UserToAdd" aria-label="Default select example">
                    <option disabled selected>Wähle einen neuen Author aus</option>
                    @foreach($potentielleAuthoren as $person)
                        <option value="{{$person->id}}">{{$person->VollerName}}</option>
                    @endforeach
                </select>
                <button class="my-3 btn btn-outline-success" type="submit">hinzufügen</button>
            </form>

        @else
            <small class="text-warning">Es gibt keine Nutzer mehr, die du zum Author machen kannst!</small>
        @endif
        </div>
    </div>
    <div class="card my-3">
        <div class="card-header">
            <h4>Übersicht</h4>
        </div>
        <div class="card-body">

        @if(count($authoren)>0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">email</th>
                        <th scope="col">Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($authoren as $person)
                    <tr>
                        <th scope="row">{{$person->id}}</th>
                        <td>{{$person->VollerName}}</td>
                        <td><a href="mailto:{{$person->email}}">{{$person->email}}</a></td>
                        <td>
                            {{-- Man soll sich nicht selbst löschen können --}}
                            @if($person->id != Auth::user()->id)
                            <form method="POST" action="{{ route('AuthorDeleteAuthor') }}">
                                @csrf
                                <input type="hidden" id="id" name="id" value="{{$person->id}}">
                                <button class="btn btn-outline-danger" type="submit">löschen</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        <hr class="dropdown-divider">
        @else
            <small class="text-warning">Es gibt noch keine Authoren</small>
        @endif
        </div>
    </div>
@endif
@endsection
