<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beitrag extends Model
{
    use HasFactory;
    protected $table='beitraege';
    protected $fillable =[
        'name',
        'html',
        'beschreibung',
        'aktiv'
    ];
}
