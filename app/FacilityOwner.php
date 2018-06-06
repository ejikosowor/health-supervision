<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacilityOwner extends Model
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
    protected $table = 'facility_owners';

    /**
     * Get the health facilities owned.
     */
    public function facilities(){
        return $this->hasMany('App\Facility');
    }
}
