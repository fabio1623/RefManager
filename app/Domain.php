<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    /**
     * The expertises that belong to the domain.
     */
    public function expertises()
    {
        return $this->hasMany('App\Expertise');
    }

    public function subsidiaries()
    {
        return $this->belongsToMany('App\Subsidiary');
    }
}
