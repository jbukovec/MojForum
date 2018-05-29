<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategorija extends Model
{
    //
    protected $table = 'kategorije';

    public function teme()
    {
        return $this->hasMany('App\Tema');
    }
}
