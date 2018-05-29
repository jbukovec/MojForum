<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tema extends Model
{
    use Searchable;

    protected $table = 'teme';
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function kategorija()
    {
        return $this->belongsTo('App\Kategorija');
    }
    public function komentari()
    {
        return $this->hasMany('App\Komentar');
    }
    public function searchableAs()
    {
        return 'teme_index';
    }
    public function toSearchableArray()
    {
        //$array = $this->toArray();
        $array = array_only($this->toArray(), ['id', 'naslov_teme', 'opis_teme']);
        // Customize array...

        return $array;
    }
}
