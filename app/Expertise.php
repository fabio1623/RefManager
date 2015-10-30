<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    /**
     * The domains that belong to the expertise.
     */
    public function domains()
    {
        return $this->belongsToMany('App\Domain');
    }
}
