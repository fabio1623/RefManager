<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The measures that belong to the category.
     */
    public function measures()
    {
        return $this->hasMany('App\Measure');
    }

    public function subsidiaries()
    {
        return $this->belongsToMany('App\Subsidiary');
    }
}
