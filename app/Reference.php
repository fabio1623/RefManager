<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Gbrock\Table\Traits\Sortable;

class Reference extends Model
{
    use Sortable;

    /**
     * The attributes which may be used for sorting dynamically.
     *
     * @var array
     */
    protected $sortable = ['project_number', 'dfac_name', 'start_date', 'end_date', 'client', 'country', 'zone', 'total_project_cost'];

    public function subsidiary()
    {
        return $this->belongsTo('App\Subsidiary');
    }

    public function contributors()
    {
        return $this->belongsToMany('App\Contributor');
    }

    public function external_services()
    {
        return $this->belongsToMany('App\ExternalService');
    }

    public function internal_services()
    {
        return $this->belongsToMany('App\InternalService');
    }

    public function expertises()
    {
        return $this->belongsToMany('App\Expertise');
    }

    public function measures()
    {
        return $this->belongsToMany('App\Measure');
    }

    public function qualifiers()
    {
        return $this->belongsToMany('App\Qualifier');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Language');
    }
    public function fundings()
    {
        return $this->belongsToMany('App\Funding');
    }
}
