<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class slikaProfila extends Model
{
    protected $table = 'slike_profila';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
