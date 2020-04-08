@extends('oeffentlich.layout')

@section('content')
    <h1>Satzung</h1>
    <object class="w-50" data="{{ asset('file/satzung.pdf') }}" style="height:100vh;">
        <!-- <a href="object.pdf">PDF laden</a> -->
    </object>
@endsection