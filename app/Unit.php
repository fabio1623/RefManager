<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function measures()
    {
        return $this->belongsToMany('App\Measure');
    }
}
