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

    public function internal_services()
    {
        return $this->belongsToMany('App\InternalService');
    }

    public function domains()
    {
        return $this->belongsToMany('App\Domain');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function expertises()
    {
        return $this->belongsToMany('App\Expertise');
    }

    public function measures()
    {
        return $this->belongsToMany('App\Measure');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Language');
    }
}
