<?php

namespace App;

use App\User;
use App\Role;
use App\Institution;
use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'institution_role_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['institution_id', 'user_id', 'role_id'];

}
