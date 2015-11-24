<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    public function contributors()
    {
        return $this->belongsToMany('App\Contributor');
    }

    public function services()
    {
        return $this->belongsToMany('App\SubService');
    }
}
