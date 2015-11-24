<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public function countries()
    {
        return $this->belongsToMany('App\Country');
    }
}
