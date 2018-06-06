<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
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
        'name',
    ];

    /**
     * Get the sub counties under a county.
     */
    public function subcounties(){
        return $this->hasMany('App\SubCounty');
    }

    /**
     * Get the health facilities under a county.
     */
    public function facilities(){
        return $this->hasMany('App\Facility');
    }
}