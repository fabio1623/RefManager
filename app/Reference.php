<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    public function contributors()
    {
        return $this->belongsToMany('App\Contributor');
    }

    public function external_services()
    {
        return $this->belongsToMany('App\ExternalService');
    }

    public function internal_services()
    {
        return $this->belongsToMany('App\InternalService');
    }

    public function expertises()
    {
        return $this->belongsToMany('App\Expertise');
    }

    public function measures()
    {
        return $this->belongsToMany('App\Measure');
    }

    public function qualifiers()
    {
        return $this->belongsToMany('App\Qualifier');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Language');
    }
}
