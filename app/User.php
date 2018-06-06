<?php

namespace App;

use App\Events\NewUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The event map for the model.
     *
     * @var array
     */
     protected $dispatchesEvents = [
        'created' => NewUser::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role_id', 'facility_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Handle the incoming request.
     *
     * @param  int  $role
     * @return boolean
     */
    public function hasRole($role){
        if($role == $this->role_id){
            return true;
        } else {
            return false;
        }
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    /**
     * Get supervisions the user carried out
     */
    public function supervisions(){
        return $this->hasMany('App\Supervision');
    }

    /**
     * Get the facility the facility the user belongs to
     */
    public function facility(){
        return $this->belongsTo('App\Facility');
    }

    /**
     * Get the supervisions the user jointly carried out
     */
    public function collaborations(){
        return $this->belongsToMany('App\Supervision');
    }
}