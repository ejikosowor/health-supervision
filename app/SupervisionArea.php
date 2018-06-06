<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupervisionArea extends Model
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
     * Get survey questions addressing this supervision area.
     */
    public function questions(){
        return $this->hasMany('App\Question');
    }
}