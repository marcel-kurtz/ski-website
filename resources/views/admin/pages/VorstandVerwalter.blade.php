@extends('admin.layout')

@section('content')
    <h1>Admin Vorstand Verwalter</h1>
    <h2>Vorstand</h2>
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
            <th scope="col">Als Vorstand entfernen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vorstaende as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->tel }}</td>
                    <td>{{ date( "d.m.Y" , strtotime($user->birthdate) ) }}</td>
                    <td>{{ $user->strasse }},<br> {{ $user->plz }} {{ $user->ort }}</td>
                    <td>
                        <form action="/admin/vorstand/del/admin" method="POST">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <button type="submin" class="btn btn-danger">entfernen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="/admin/vorstand/add/vorstand" method="POST">
    @csrf
        <label for="addVorstand">Vorstand hinzufügen</label>
        <input list="potentielleVorstaende" id="addVorstand" name="addVorstand" required/>
        <datalist id="potentielleVorstaende">
            @foreach ($usersNoVorstand as $userNoVorstand)
                <option value="{{ $userNoVorstand->name }};{{ $userNoVorstand->firstname }}">
            @endforeach
        </datalist>
        <button type="submit">hinzufügen</button>

    </form>
    <hr>
    <h2>Admins</h2>
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
            <th scope="col">als Admin enfternen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->tel }}</td>
                    <td>{{ date( "d.m.Y" , strtotime($user->birthdate) ) }}</td>
                    <td>{{ $user->strasse }},<br> {{ $user->plz }} {{ $user->ort }}</td>
                    <td>
                        <form action="/admin/vorstand/del/admin" method="POST">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <button type="submin" class="btn btn-danger">entfernen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="/admin/vorstand/add/admin" method="POST">
    @csrf
        <label for="addAdmin">Admin hinzufügen</label>
        <input list="potentielleAdmins" id="addAdmin" name="addAdmin" required/>
        <datalist id="potentielleAdmins">
            @foreach ($usersNoAdmin as $userNoAdmin)
                <option value="{{ $userNoAdmin->name }};{{ $userNoAdmin->firstname }}">
            @endforeach
        </datalist>
        <button type="submit">hinzufügen</button>

    </form>
@endsection