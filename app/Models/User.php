<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        'firstname',
        'birthdate',
        'strasse',
        'plz',
        'ort',
        'tel',

        // role feature removed an 2021-12-13
        // 'role',
        'aktiv',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    public function getEmailAttribute()
    {
        return strtolower($this->attributes['email']);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getVollerNameAttribute() {
        return $this->attributes['firstname'] . ' ' . $this->attributes['name'];
    }

    public function roles()
    {
        return $this->hasManyThrough(
            UserRoles::class,
            userHasRole::class,
            'user_id',
            'id',
            'id',
            'user_role_id'
        );
    }

    /**
     * Gibt boolean, ob eine bestimmte Rolle einem Nutzer zugewiesen ist.
     * Ein Admin bekommt immer Zugriff auf alle Ressourcen
     *
     * @param String
     * @return boolean
     */
    public function hasRole($role) {
        $roles = json_decode($this->roles()->pluck('name') , true ) ;
        return in_array ( strtolower($role) , $roles );
    }
}

