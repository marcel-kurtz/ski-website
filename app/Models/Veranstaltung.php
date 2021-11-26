<?php

namespace App\Models;

use App\Models\Models\dokumente;
use Illuminate\Database\Eloquent\Model;

class Veranstaltung extends Model
{
    protected $table = 'veranstaltung';
    protected $fillable = [
        'start',
        'ende',
        'anmelde_start',
        'anmelde_ende',
        'active',
        'preis',
        'max_teilnehmer',
        'beschreibung',
        'titel',
        'pflicht_angaben',
        'freiwillige_angaben',
        'ansprechpartner'
    ];
    // public function getAnsprechpartner() {
    //     return $this->belongsTo('App\Models\User','ansprechpartner','id');
    // }
    public function teilnahmen () {
        return $this->hasMany('App\Models\VeranstaltungTeilnahme','veranstaltung');
    }
    public function teilnehmer () {
        return $this->hasManyThrough(
            User::class,
            VeranstaltungTeilnahme::class,
            'veranstaltung',
            'id',
            'id',
            'teilnehmer'
        );
    }

    public function ansprechpartner() {
        return $this->hasOne(User::class, 'ansprechpartner');
    }

    public function dokumente() {
        return $this->hasManyThrough(
            dokumente::class,
            VeranstaltungDokumentMapping::class,
             'veranstaltung',
             'id',
             'id',
             'dokument'
        );
    }

    public function noneMembers() {
        return $this->hasMany(NoneMembers::class, 'veranstaltung', 'id');
    }

    protected $casts = [
        'start' => 'datetime',
        'ende' => 'datetime',
        'anmeldeStart' => 'datetime',
        'active' => 'boolean',
        'preis' => 'decimal:2',
        'maxTeilnehmer' => 'integer',
        'beschreibung' => 'string',
        'titel' => 'string',
    ];
}
