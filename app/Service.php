<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function subServices()
    {
        return $this->belongsToMany('App\SubService', 'sub_service_services');
    }
}
