<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    public function services()
    {
        return $this->belongsToMany('App\Services');
    }
}
