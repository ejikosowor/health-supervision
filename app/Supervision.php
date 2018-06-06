<?php

namespace App;

use App\Events\NewSupervision;
use Illuminate\Database\Eloquent\Model;

class Supervision extends Model
{    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supervision_category_id', 'facility_id', 'user_id', 'longitude', 'latitude'
    ];

    /**
     * Get the facility the supervision was carried out on
     */
    public function facility(){
        return $this->belongsTo('App\Facility');
    }

    /**
     * Get the user who carried out the supervision
     */
    public function supervisor(){
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the suprevision category the supervision belongs to.
     */
    public function category(){
        return $this->belongsTo('App\SupervisionCategory', 'supervision_category_id');
    }

    public function transactions(){
        return $this->hasMany('App\Transaction');
    }

    /**
     * Get the users who jointly carried out the supervision
     */
    public function collaborators(){
        return $this->belongsToMany('App\User');
    }
}
