<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public function countries()
    {
        return $this->belongsToMany('App\Country');
    }

    public function manager()
    {
    	return $this->belongsTo('App\Contributor', 'manager', 'id');
    }

    public function references()
    {
    	return $this->hasMany('App\Reference', 'zone');
    }
}
