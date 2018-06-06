<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacilityType extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'facility_types';

    /**
     * Get the health facilities under a facility type.
     */
    public function facilities(){
        return $this->hasMany('App\Facility');
    }
}
