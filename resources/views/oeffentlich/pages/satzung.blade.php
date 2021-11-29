@extends('oeffentlich.layout')

@section('content')
    <h1>Satzung</h1>
    <div class="d-flex align-self-stretch">
    <embed src="{{ Storage::url('file/satzung.pdf') }}"
           class="w-50"
           style="height:100vh"
           type="application/pdf">
    </div>
@endsection
