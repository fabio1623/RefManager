<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    public function subsidiary()
    {
        return $this->belongsTo('App\Subsidiary');
    }

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
    public function fundings()
    {
        return $this->belongsToMany('App\Funding');
    }

    public function client()
    {
        return $this->belongsTo('App\Client', 'client');
    }

    public function country()
    {
        return $this->belongsTo('App\Country', 'country');
    }

    public function zone()
    {
        return $this->belongsTo('App\Zone', 'zone');
    }
}
