@extends('Vorstand.layout')


@section('content')
    <h1>Vorstand Home</h1>
    <h2>Mitgliederliste</h2>
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Vorname</th>
            <th scope="col">Nachname</th>
            <th scope="col">Mail</th>
            <th scope="col">Telefon</th>
            <th scope="col">Geburtstag</th>
            <th scope="col">Adresse</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mitglieder as $mitglied)
                <tr>
                    <th scope="row">{{ $mitglied->id }}</th>
                    <td>{{ $mitglied->firstname }}</td>
                    <td>{{ $mitglied->name }}</td>
                    <td>{{ $mitglied->email }}</td>
                    <td>{{ $mitglied->tel }}</td>
                    <td>{{ date( "d.m.Y" , strtotime($mitglied->birthdate) ) }}</td>
                    <td>{{ $mitglied->strasse }},<br> {{ $mitglied->plz }} {{ $mitglied->ort }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection