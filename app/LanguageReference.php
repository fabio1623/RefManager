<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguageReference extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'language_reference';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
