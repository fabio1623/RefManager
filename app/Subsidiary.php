<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function references()
    {
        return $this->hasMany('App\Reference');
    }

    public function external_services()
    {
        return $this->belongsToMany('App\ExternalService');
    }
}
