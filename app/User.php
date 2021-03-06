<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use \App\Role;
use \App\Institution;
use Illuminate\Support\Facades\Auth;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstName', 'lastName', 'address', 'city', 'zip', 'country', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'isAdmin'];

    /**
     * Returns the Gravatar URL to display a profile picture
     * @return string
     */
    public function getGravatarAttribute()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=150";
    }

    /**
     * Returns the users full name by combining the first and last name
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ($this->attributes['firstName'] . ' ' . $this->attributes['lastName']);
    }

    /**
     * Establish the belongsToMany relationship to the Roles model
     * @return mixed
     */
    public function roles()
    {
        return $this->belongstoMany(Role::class, 'institution_role_user')->withPivot('institution_id');
    }

    /**
     * Checks if the user has the given role
     *
     * @param $role
     * @return mixed
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        // Intersection removes all items which are supplied from the roles() method
        return !!$role->intersect($this->roles)->count();;
    }

    public function hasSuperpowers()
    {
        return !! $this->isAdmin;
    }

    /**
     *  courses I lead.
     *  Relationship with Courses
     */
    public function ownedCourses()
    {
        return $this->hasMany('App\Course', 'assignedOwner');
    }

    /**
     *  courses I participate
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany('App\Course','user_course');
    }

    /**
     * Returns all institutions, which are assigned to a user with a certain role
     * @param null $role
     * @return mixed
     */
    public function institutions($role = null)
    {
        if (! $role) {
            return $this->belongstoMany(Institution::class, 'institution_role_user')->withPivot('role_id');
        } else {
            return $this->belongstoMany(Institution::class, 'institution_role_user')->withPivot('role_id')->where('role_id', $role);
        }
    }

    public function bills()
    {
        return $this->hasMany('App\Bill');
    }

}
