<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    /**
     * The categories that belong to the measure.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function units()
    {
        return $this->belongsToMany('App\Unit');
    }

    public function references()
    {
        return $this->belongsToMany('App\Reference');
    }

    public function qualifiers()
    {
        return $this->belongsToMany('App\Qualifier');
    }
}
