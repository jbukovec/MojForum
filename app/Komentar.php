<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    //
    protected $table = 'komentari';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tema()
    {
        return $this->belongsTo('App\Tema');
    }
}
