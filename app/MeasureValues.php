<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasureValues extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'measure_reference';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
