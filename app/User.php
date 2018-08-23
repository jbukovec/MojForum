<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Searchable;
    use Notifiable;
    use Sluggable;
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

    public function toSearchableArray()
    {
        //$array = $this->toArray();
        $array = array_only($this->toArray(), ['id', 'name']);
        return $array;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
