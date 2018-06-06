<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer', 'question_id', 'supervision_id'
    ];

    /**
     * Get the facility the survey was carried out on
     */
    public function facility(){
        return $this->belongsTo('App\Facility');
    }

    /**
     * Get the user who carried out the survey
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * Get question it answers.
     */
    public function question(){
        return $this->belongsTo('App\Question');
    }
}