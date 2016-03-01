<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function references()
    {
        return $this->belongsToMany('App\Reference');
    }

    public function subsidiaries()
    {
        return $this->belongsToMany('App\Subsidiary');
    }
}
