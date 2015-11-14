<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function locations()
    {
        return $this->hasMany('App\Location');
    }
}
