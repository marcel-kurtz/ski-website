@extends('layouts.app')

@section('content')
    <h1>Impressum</h1>

    {!!
        \App\Models\WebsiteParts::where('name','impressum')->first()->html;
    !!}

@endsection
