<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /*
     * relatioship with Institute
     */
    public function institution(){
        return $this->belongsTo('App\Institution','assignedInstitution');
    }

    /*
     * Relationship with User
     */
    public function user(){
       return $this->belongsTo('App\User','assignedOwner');
    }
}
