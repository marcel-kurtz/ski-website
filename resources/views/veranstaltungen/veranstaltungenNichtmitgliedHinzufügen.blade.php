@extends('layouts.app')


@section('content')
    <div class="card text-center">
        <div class="card-header">
            Teilnehmer ohne Vereinszugehörigkeit zur Veranstaltung hinzufügen
        </div>
        <div class="card-body d-flex justify-content-center">
            <form method="POST" action="{{ route('Veranstaltung_Nichtmitglied_hinzufügen_Submit') }}">
                @csrf
                <input type="hidden" name="veranstaltung" id="veranstaltung" value="{{ $veranstaltung->id }}">
                <div class="mb-3">
                    <label for="FilesToUpload" class="form-label">Name</label>
                    <input class="form-control form-control-lg" id="Name" name="Name" type="text" required>
                </div>
                <div class="mb-3">
                    <label for="FilesToUpload" class="form-label">Email</label>
                    <input class="form-control form-control-lg" id="email" name="email" type="email" required>
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" required>
                    <label class="form-check-label" for="flexCheckDefault">
                        Die Person, deren Daten oben eingetragen hat, hat eine eindeutige Zustimmung erteilt.
                    </label>
                </div>

                <button type="submit" class="btn btn-success">Person hinzufügen</button>
            </form>
        </div>

    </div>
@endsection
