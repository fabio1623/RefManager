<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualifier extends Model
{
    public function measures()
    {
        return $this->belongsToMany('App\Measure');
    }

    public function references()
    {
        return $this->belongsToMany('App\Reference');
    }
}
