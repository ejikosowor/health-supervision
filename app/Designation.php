<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
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

    public function facilities(){
        return $this->hasMany('App\Facility', 'contact_designation_id');
    }
}
