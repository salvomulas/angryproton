<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permission;

class Role extends Model
{
    /**
     * Establish the belongsToMany relationship to the Permission model to return all permissions
     *
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Grants a permission to the given role
     * @param \App\Permission $permission
     * @return mixed
     */
    public function grantPermission (Permission $permission)
    {
        return $this->permissions()->save($permission);
    }
}
