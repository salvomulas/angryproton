<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /*
     * relatioship with Institute
     */
    public function institution()
    {
        return $this->belongsTo('App\Institution', 'assignedInstitution');
    }

    /*
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'assignedOwner');
    }

    /**
     * Checks if the User owns the course
     * @param User $user
     * @return bool
     */
    public function isOwner(User $user)
    {
        return $this->assignedOwner === $user->id;
    }

    /**
     * Returns the participants of the given course
     * @return mixed
     */
    public function participants()
    {
        return $this->belongsToMany('App\User', 'user_course');
    }
}
