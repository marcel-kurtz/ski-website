<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeranstaltungDokumentMapping extends Model
{
    use HasFactory;

    protected $table = 'VeranstaltungDokumentMapping';
    protected $primaryKey = 'id';

    protected $fillable = [
        'veranstaltung',
        'dokument'
    ];
}
