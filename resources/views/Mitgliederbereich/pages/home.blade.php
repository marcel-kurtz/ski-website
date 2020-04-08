@extends('Mitgliederbereich.layout')

@section('content')
    <h1>Herzlich Wilkommen {{ Auth::user()->firstname }}</h1>
    <div class="row">
        <div class="col-8 border"></div>
        <div class="col-4 border">
            <div href="/member/myLizenzen" class="col">
                <div class="row">
                    <h3>Deine Lizenzen</h3>
                </div>
                @foreach ($lizenzen as $lizenz)
                    <div class="row">
                        {{ $lizenz->disziplin }} | 
                        {{ $lizenz->niveau }} | 
                        aktiv bis: {{ date('d.m.Y', strtotime( $lizenz->letzteFortbilung ) . '+' .  ($lizenz->letzteFortbilungTage > 3) ? "3" : strval($lizenz->letzteFortbilungTage)  . 'year' )  }}
                        aktiv bis: {{ date('d.m.Y', strtotime( $lizenz->letzteFortbilung  . '+ 3 year' ) )  }}
                        {{ ($lizenz->letzteFortbilungTage > 3) ? 3 : $lizenz->letzteFortbilungTage }}

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection