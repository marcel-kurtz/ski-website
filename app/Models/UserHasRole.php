<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasRole extends Model
{
    use HasFactory;
    protected $table = 'userHasRole';
    protected $fillable= [
        'user_id',
        'user_role_id'
    ];
}
