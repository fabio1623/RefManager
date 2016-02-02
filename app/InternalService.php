<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalService extends Model
{
    public function parent_service()
    {
        return $this->hasOne('App\ExternalService');
    }

    public function references()
    {
        return $this->belongsToMany('App\Reference');
    }

    public function subsidiaries()
    {
        return $this->belongsToMany('App\Subsidiary');
    }
}
