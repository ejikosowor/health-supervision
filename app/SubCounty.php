<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCounty extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sub_counties';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'county_id'
    ];

    /**
     * Get the county that the sub county is under.
     */
    public function county(){
        return $this->belongsTo('App\County');
    }

    /**
     * Get the health facilities under a sub county.
     */
    public function facilities(){
        return $this->hasMany('App\Facility', 'sub_county_id');
    }
}
