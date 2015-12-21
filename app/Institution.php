<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'address', 'city', 'zip', 'country'];

    /*
     *
     *  relationship with the User Class
     */
    public function user(){
        return $this->belongsTo('User','assignedOwner');
    }

    /**
     *  Relationship with Courses
     */
    public function courses(){
        return $this->hasMany('Course','assignedInstitution');
    }

}
