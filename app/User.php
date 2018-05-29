<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profilne_slike()
    {
       return $this->hasMany('App\slikaProfila');
    }
    public function teme()
    {
        return $this->hasMany('App\Tema');
    }
    public function komentari()
    {
        return $this->hasMany('App\Komentar');
    }
}