<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    /**
     * The categories that belong to the measure.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
