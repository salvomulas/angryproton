<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;

class Permission extends Model
{
    /**
     * Establish the belongsToMany relationship to the Role model
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
}
