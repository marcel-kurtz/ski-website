<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class   VeranstaltungTeilnahme extends Model
{
    protected $table = 'veranstaltung_teilnahme';
    protected $primaryKey = 'id';
    protected $fillable = [
        'veranstaltung',
        'pflicht_angaben',
        'freiwillige_angaben',
        'teilnehmer',
        'bemerkungen',
    ];

    public function veranstaltung () {
        return $this->belongsTo('App\Models\Veranstaltung','veranstaltung','id');
    }
    public function teilnehmer () {
        return $this->belongsTo('App\Models\User','teilnehmer','id');
    }
    protected $casts = [
        'bemerkungen' => 'string',
    ];
}
