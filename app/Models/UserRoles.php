<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = 'user_roles';
    protected $fillable= [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(
            'App\Models\User',
            'userHasRole',
            'user_role_id',
            'user_id'
        );
    }
}
