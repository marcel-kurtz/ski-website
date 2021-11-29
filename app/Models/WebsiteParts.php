<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteParts extends Model
{
    use HasFactory;
    protected $table='website_parts';
    protected $fillable =[
        'name',
        'html'
    ];
}
