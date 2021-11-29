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

<h2>Website Parts</h2>
<div class="col col-lg-7">
@foreach($websiteparts as $part)
    <div class="col mb-3">
        <form action="{{ route('updateWebsitePart', ["part" => $part->id ]) }}" method="POST">
            @csrf
            <div><h3>{{$part->name}}</h3></div>
            <div><small>{{$part->beschreibung}}</small></div>
            <div><input type="hidden" id="id" name="id" value="{{$part->id}}"></div>
            <div><textarea class="w-100" rows="3" id="html" name="html">{{$part->html}}</textarea></div>
            <div><button class="btn btn-sm btn-outline-success" type="submit">speichern</button></div>
        </form>
    </div>
    @if(!$loop->last)
        <hr class="dropdown-divider">
    @endif
@endforeach
</div>
@endsection
