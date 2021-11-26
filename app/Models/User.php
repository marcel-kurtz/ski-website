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

        'role',
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
        Log::info($this->attributes['email']);
    }
    public function getEmailAttribute()
    {
        Log::info(strtolower($this->attributes['email']));
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
        $result = $this->belongsToMany (
            'App\Models\UserRoles',
            'userHasRole',
            'user_id',
            'user_role_id'
        );
        return $result;
    }

    /**
     * Gibt an, ob eine bestimmte Rolle einem Nutzer zugewiesen ist.
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

