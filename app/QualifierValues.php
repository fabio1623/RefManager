<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualifierValues extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'qualifier_reference';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
