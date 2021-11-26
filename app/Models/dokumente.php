<?php

namespace App\Models\Models;

use App\Models\Veranstaltung;
use App\Models\VeranstaltungDokumentMapping;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokumente extends Model
{
    use HasFactory;

    protected $table = 'Dokumente';
    protected $primaryKey = 'id';

    protected  $fillable = [
        'path',
        'type',
        'name'
    ];


    public function veranstaltung()
    {
        return $this->hasOneThrough(
            Veranstaltung::class,
            VeranstaltungDokumentMapping::class,
            'dokument',
            'id',
            'id',
            'veranstaltung'
        );
    }

}
