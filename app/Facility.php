<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'facility_code', 'facility_owner_id', 'contact_name', 'contact_designation_id', 'county_id', 'sub_county_id', 'longitude', 'latitude'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'contact_designation_id', 'county_id', 'sub_county_id',
    ];

    /**
     * Get the county that the facility belongs to.
     */
    public function county(){
        return $this->belongsTo('App\County');
    }

    /**
     * Get the county that the facility belongs to.
     */
    public function SubCounty(){
        return $this->belongsTo('App\SubCounty');
    }

    /**
     * Get the designation of facility contact person.
     */
    public function ContactDesignation(){
        return $this->belongsTo('App\Designation');
    }

    /**
     * Get the users under a facility.
     */
    public function users(){
        return $this->hasMany('App\User');
    }
    
    /**
     * Get surveys carried out in a facility.
     */
    public function supervisions(){
        return $this->hasMany('App\Supervision');
    }

    /**
     * Get the facility type
     */
    public function type(){
        return $this->belongsTo('App\FacilityType', 'facility_type_id');
    }

    /**
     * Get the facility owner
     */
    public function owner(){
        return $this->belongsTo('App\FacilityOwner', 'facility_owner_id');
    }
}
