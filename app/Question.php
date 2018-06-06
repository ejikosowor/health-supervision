<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'supervision_category_id', 'supervision_area_id', 'question_type_id', 'parent_id'
    ];

    /**
     * Get the suprevision category the question belongs to.
     */
    public function category(){
        return $this->belongsTo('App\SupervisionCategory', 'supervision_category_id');
    }

    /**
     * Get the suprevision area the question addresses.
     */
    public function area(){
        return $this->belongsTo('App\SupervisionArea', 'supervision_area_id');
    }

    /**
     * Get the question type
     */
    public function type(){
        return $this->belongsTo('App\QuestionType', 'question_type_id');
    }

    /**
     * Get sub-questions.
     */
    public function subQuestions(){
        return $this->hasMany('App\Question', 'parent_id');
    }

    /**
     * Get answers to the question.
     */
     public function answers(){
        return $this->hasMany('App\Transaction');
    }
    
}