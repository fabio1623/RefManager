<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    /**
     * The domains that belong to the expertise.
     */
    public function domain()
    {
        return $this->belongsTo('App\Domain');
    }

    public function references()
    {
        return $this->belongsToMany('App\Reference');
    }

    public function subsidiaries()
    {
        return $this->belongsToMany('App\Subsidiary');
    }
}
