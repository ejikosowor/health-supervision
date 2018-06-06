<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupervisionCategory extends Model
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
     * Get survey questions under supervision category.
     */
    public function questions(){
        return $this->hasMany('App\Question');
    }

    /**
     * Get surveys done under supervision category.
     */
    public function supervisions(){
        return $this->hasMany('App\Supervision');
    }
}