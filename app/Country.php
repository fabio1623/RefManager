<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    public function zones()
    {
        return $this->belongsToMany('App\Zone');
    }

    public function references()
    {
    	return $this->hasMany('App\Reference');	
    }
}
