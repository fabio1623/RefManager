<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function contacts()
    {
        return $this->belongsToMany('App\Contact');
    }
}
