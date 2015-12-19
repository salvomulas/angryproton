<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // Wrapped within try/catch to avoid migration problems in testing
        try {

            // Get permissions from the database
            foreach ($this->getPermissions() as $permission) {
                $gate->define($permission->name, function ($user) use ($permission) {
                    return $user->hasRole($permission->roles);
                });
            }

            // Get owner of a course and define permission to modify
            $gate->define('update-course', function ($user, $course) {
                return $user->id === $course->assignedOwner;
            });

            // Get owner of an institution and define permission to modify
            //$gate->define('update-institution', function ($user, $course) {
            //    return $user->id === $course->assignedOwner;
            //});

        } catch (QueryException $e) {
            return false;
        }
    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }

}
