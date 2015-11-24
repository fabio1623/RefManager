<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalService extends Model
{
    public function subService()
    {
        return $this->hasOne('App\ExternalService');
    }
}
