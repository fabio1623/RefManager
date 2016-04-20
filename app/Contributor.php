<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    public function references()
    {
        return $this->belongsToMany('App\Reference');
    }

    public function zones()
    {
        return $this->hasMany('App\Zone', 'manager', 'id');
    }
}
