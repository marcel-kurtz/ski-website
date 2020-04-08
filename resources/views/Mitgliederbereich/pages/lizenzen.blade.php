@extends('Mitgliederbereich.layout')

@section('content')
    <h1>Meine Lizenzen</h1>
    <hr>
    <div id="Lizenz">
        <div class="collapseButton card-header w-100 border" id="neuerLizenz" data-toggle="collapse" data-target="#neuerLizenzEingabe" aria-expanded="false" aria-controls="neuerLizenzEingabe">
            Neue Lizenz erstellen
            <i class="fas fa-plus"></i>
        </div>  
        <section  class="m-3 col-12 col-md-7 collapse" id="neuerLizenzEingabe" name="neuerLizenzEingabe" aria-labelledby="neuerLizenz" data-parent="#Lizenz">
            <h2>Persönliche DateNeue Lizenz erstellenn</h2>
            <form method="POST" action="/member/myLizenz/neu" class="row">
            @csrf
                <div class="form-group col-12 col-md-6">
                    <label for="disziplin">Disziplin</label>
                    <select class="form-control" type="text" name="disziplin" id="disziplin" placeholder="disziplin" value="{{ $lizenz->disziplin ?? '' }}"> 
                        <option value="Skitour">Skitour</option>    
                        <option value="Alpin">Alpin</option>
                        <option value="Snowboard">Snowboard</option>
                        <option value="Telemark">Telemark</option>
                        <option value="Nordic">Nordic</option>
                        
                    </select>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="verband">Verband</label>
                    <select class="form-control" type="text" name="verband" id="verband" placeholder="verband" value="{{ $lizenz->verband ?? '' }}"> 
                        <option value="DSV">DSV</option>
                        <option value="DSLV">DSLV</option>
                        <option value="ÖSV">ÖSV</option>
                    </select>
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="niveau">Niveau</label>
                    <select class="form-control" type="text" name="niveau" id="niveau" placeholder="niveau" value="{{ $lizenz->niveau ?? '' }}"> 
                        <option value="C-Trainer">C-Trainer</option>
                        <option value="B-Trainer">B-Trainer</option>
                        <option value="A-Trainer">A-Trainer</option>
                        <option value="Level 1">Level 1</option>
                        <option value="Level 2">Level 2</option>
                        <option value="Level 3">Level 3</option>
                        <option value="Level 4">Level 4</option>
                    
                    </select>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="erhalten">erhalten am</label>
                    <input class="form-control" type="date" name="erhalten" id="erhalten" placeholder="erhalten" value="{{ $lizenz->erhalten ?? '' }}"> 
                </div>

                

                <div class="form-group col-12 col-md-6">
                    <label for="letzteFortbilung">letzte Fortbilung</label>
                    <input class="form-control" type="date" name="letzteFortbilung" id="letzteFortbilung" placeholder="letzteFortbilung" value="{{ $lizenz->letzteFortbilung ?? '' }}"> 
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="letzteFortbilungNummer">letzte Fortbilungs Nummer</label>
                    <input class="form-control" type="text" name="letzteFortbilungNummer" id="letzteFortbilungNummer" placeholder="letzteFortbilungNummer" value="{{ $lizenz->letzteFortbilungNummer ?? '' }}"> 
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="letzteFortbilungTage">letzte Fortbilung Tage</label>
                    <input class="form-control" type="number" name="letzteFortbilungTage" id="letzteFortbilungTage" placeholder="letzteFortbilungTage" value="{{ $lizenz->letzteFortbilungTage ?? '' }}"> 
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="letzterErsteHilfeKurs">letzter Erste-Hilfe-Kurs</label>
                    <input class="form-control" type="date" name="letzterErsteHilfeKurs" id="letzterErsteHilfeKurs" placeholder="letzterErsteHilfeKurs" value="{{ $lizenz->letzterErsteHilfeKurs ?? '' }}"> 
                </div>
                
                <div class="form-group col-7">
                    <button class="btn btn-secondary" type="submit">anlegen</button>
                </div>        
            </form>
        </section>
    </div>
    <hr>
    <section name="PersoenlicheDaten" class="m-3 col-12 col-md-7">
        <h2>Bestehende Lizenzen</h2>
        @foreach ( $lizenzdaten as $lizenz )
            <form method="POST" action="/member/myLizenz" class="row">
            @csrf
                <input class="form-control" type="hidden" name="lizenzId" id="lizenzId" value="{{ $lizenz->id ?? '' }}"> 
                <div class="form-group col-12 col-md-6">
                    <label for="disziplin">Disziplin</label>
                    <select class="form-control" type="text" name="disziplin" id="disziplin" placeholder="disziplin" value="{{ $lizenz->disziplin ?? '' }}"> 
                        <option value="Skitour" {{ ($lizenz->disziplin == 'Skitour') ? "selected": "" }} >Skitour</option>    
                        <option value="Alpin" {{ ($lizenz->disziplin == 'Alpin') ? "selected": "" }} >Alpin</option>
                        <option value="Snowboard" {{ ($lizenz->disziplin == 'Snowboard') ? "selected": "" }} >Snowboard</option>
                        <option value="Telemark" {{ ($lizenz->disziplin == 'Telemark') ? "selected": "" }} >Telemark</option>
                        <option value="Nordic" {{ ($lizenz->disziplin == 'Nordic') ? "selected": "" }} >Nordic</option>
                        
                    </select>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="verband">Verband</label>
                    <select class="form-control" type="text" name="verband" id="verband" placeholder="verband" value="{{ $lizenz->verband ?? '' }}"> 
                        <option value="DSV" {{ ($lizenz->verband == 'DSV') ? "selected": "" }} >DSV</option>
                        <option value="DSLV" {{ ($lizenz->verband == 'DSLV') ? "selected": "" }} >DSLV</option>
                        <option value="ÖSV" {{ ($lizenz->verband == 'ÖSV') ? "selected": "" }} >ÖSV</option>
                    </select>
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="niveau">Niveau</label>
                    <select class="form-control" type="text" name="niveau" id="niveau" placeholder="niveau" value="{{ $lizenz->niveau ?? '' }}"> 
                        <option value="C-Trainer" {{ ($lizenz->niveau == 'C-Trainer') ? "selected": "" }} >C-Trainer</option>
                        <option value="B-Trainer" {{ ($lizenz->niveau == 'B-Trainer') ? "selected": "" }} >B-Trainer</option>
                        <option value="A-Trainer" {{ ($lizenz->niveau == 'A-Trainer') ? "selected": "" }} >A-Trainer</option>
                        <option value="Level 1" {{ ($lizenz->niveau == 'Level 1') ? "selected": "" }} >Level 1</option>
                        <option value="Level 2" {{ ($lizenz->niveau == 'Level 2') ? "selected": "" }} >Level 2</option>
                        <option value="Level 3" {{ ($lizenz->niveau == 'Level 3') ? "selected": "" }} >Level 3</option>
                        <option value="Level 4" {{ ($lizenz->niveau == 'Level 4') ? "selected": "" }} >Level 4</option>
                    
                    </select>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="erhalten">erhalten am</label>
                    <input class="form-control" type="date" name="erhalten" id="erhalten" placeholder="erhalten" value="{{ $lizenz->erhalten ?? '' }}"> 
                </div>

                

                <div class="form-group col-12 col-md-6">
                    <label for="letzteFortbilung">letzte Fortbilung</label>
                    <input class="form-control" type="date" name="letzteFortbilung" id="letzteFortbilung" placeholder="letzteFortbilung" value="{{ $lizenz->letzteFortbilung ?? '' }}"> 
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="letzteFortbilungNummer">letzte Fortbilungs Nummer</label>
                    <input class="form-control" type="text" name="letzteFortbilungNummer" id="letzteFortbilungNummer" placeholder="letzteFortbilungNummer" value="{{ $lizenz->letzteFortbilungNummer ?? '' }}"> 
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="letzteFortbilungTage">letzte Fortbilung Tage</label>
                    <input class="form-control" type="number" name="letzteFortbilungTage" id="letzteFortbilungTage" placeholder="letzteFortbilungTage" value="{{ $lizenz->letzteFortbilungTage ?? '' }}"> 
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="letzterErsteHilfeKurs">letzter Erste-Hilfe-Kurs</label>
                    <input class="form-control" type="date" name="letzterErsteHilfeKurs" id="letzterErsteHilfeKurs" placeholder="letzterErsteHilfeKurs" value="{{ $lizenz->letzterErsteHilfeKurs ?? '' }}"> 
                </div>
                
                <div class="form-group col-7">

                    <button class="btn btn-secondary" type="submit" onclick="javascript: form.action='/member/myLizenz';">Speichern</button>
                    <button class="btn btn-secondary" type="submit" onclick="javascript: form.action='/member/myLizenz/delete';">Löschen</button>
                    <!-- <button class="btn btn-secondary" type="submit">speichern</button> -->
                </div>        
            </form>
        @endforeach
    </section>
@endsection