@extends('layouts.app')

@section('content')
<div class="card text-center">
    <div class="card-header">
        Datei hinzufügen
    </div>
    <div class="card-body d-flex justify-content-center">
        <form method="POST" action="{{ route('Veranstaltung_addFile' ,['veranstaltungsId'=> $veranstalung->id ]) }}" enctype="multipart/form-data">
        @csrf
        <label for="documentName">Dokumenten Name</label>
        <input type="text" class="form-control mb-3" id="documentName" name="documentName" placeholder="Hier Name Eingeben" required>
        <label for="FilesToUpload" class="form-label">Datei Auswählen</label>
        <input class="form-control form-control-lg mb-3" id="FilesToUpload" name="FileToUpload" type="file" required>
        <button type="submit" class="btn btn-success">hochladen</button>
        </form>
    </div>
    @if(!count($dokumente) == 0)
    <div class="card-footer text-muted">
        <div class="mx-auto col-12 col-md-8">
            <h5>Dateien</h5>
            <ul class="list-group">
                @foreach($dokumente as $dokument)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <a href="{{ Storage::url($dokument->path) }}">{{ $dokument->path }}</a>
                        </div>
                        <form action="{{ route('Veranstaltung_deleteFile') }}" method="POST">
                            @csrf
                            <input type="hidden" id="documentId" value="{{ $dokument->id }}">
                            <button class="btn btn-danger">löschen</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection
