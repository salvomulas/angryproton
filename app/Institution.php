<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

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
        return $this->hasMany(Course::class,'assignedInstitution');
    }

    /**
     * Returns all users associated to the institution by role
     * @param null $role
     * @return mixed
     */
    public function users($role = null) {
        if ($role) {
            return $this->belongstoMany(User::class, 'institution_role_user')->withPivot('role_id')->where('role_id', $role)->get();
        }
        return $this->belongstoMany(User::class, 'institution_role_user')->withPivot('role_id')->get();
    }

}
