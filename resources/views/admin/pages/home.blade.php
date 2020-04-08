@extends('admin.layout')

@section('content')
<h1>Admin Home</h1>
    <h2>Userliste</h2>
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
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->tel }}</td>
                    <td>{{ date( "d.m.Y" , strtotime($user->birthdate) ) }}</td>
                    <td>{{ $user->strasse }},<br> {{ $user->plz }} {{ $user->ort }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection