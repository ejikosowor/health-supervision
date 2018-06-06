<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
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
    protected $table = 'question_types';

    /**
     * Get the questions under a question type.
     */
    public function questions(){
        return $this->hasMany('App\Question');
    }
}
