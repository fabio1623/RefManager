<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    public function references()
    {
        return $this->belongsToMany('App\Reference');
    }
}
