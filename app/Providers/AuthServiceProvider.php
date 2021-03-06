<?php

namespace App\Providers;

use App\Permission;
use App\Course;
use App\Policies\CoursePolicy;
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
        //Course::class => CoursePolicy::class,
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

        // Grants complete access if admin
        $gate->before(function ($user) {
            if ($user->hasSuperpowers()) {
                return true;
            };
        });

        // Get owner of a course and define permission to modify
        $gate->define('update_course', function ($user, $course) {
            if ($course->isOwner($user) && $course->confirmed == false) {
                return true;
            }
            return false;
        });

        // Get owner of an institution and define permission to modify
        $gate->define('update_institution', function ($user, $institution) {
            return $institution->users(2)->contains($user);
        });

        // Wrapped within try/catch to avoid migration problems in testing
        try {

            // Get permissions from the database
            foreach ($this->getPermissions() as $permission) {
                $gate->define($permission->name, function ($user) use ($permission) {
                    return $user->hasRole($permission->roles);
                });
            }

        } catch (QueryException $e) {
            return false;
        }

    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }

}
