<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryZone extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'country_zone';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
