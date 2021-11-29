@extends('beitraege.layout')

@section('content')
    @json($beitrag)
<h1>{{ $beitrag->name }} - Bearbeiten</h1>

    {{-- Editor --}}
    <div class="editable"></div>
    {{-- !Editor --}}
@endsection
