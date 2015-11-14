<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
