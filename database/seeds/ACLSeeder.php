<?php

use Illuminate\Database\Seeder;
use \App\Permission;
use \App\Role;
use Carbon\Carbon;

class ACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {

        // Truncate tables to avoid duplicates (resets defaults!)
        DB::statement ('SET FOREIGN_KEY_CHECKS=0;');
        DB::table ('roles')->truncate ();
        DB::table ('permissions')->truncate ();

        // Seed the permissions
        // ********************

        // Permission to modify courses
        Permission::create (array (
            'name'       => 'manage_courses',
            'label'      => 'Kurse editieren',
            'created_at' => Carbon::now ()->toDateTimeString (),
        ));

        // Permission to modify courses
        Permission::create (array (
            'name'       => 'manage_institutions',
            'label'      => 'Institutionen editieren',
            'created_at' => Carbon::now ()->toDateTimeString (),
        ));

        // Seed the roles
        // **************

        // Teacher role
        Role::create (array (
            'id'         => '1',
            'name'       => 'teacher',
            'label'      => 'Dozent',
            'created_at' => Carbon::now ()->toDateTimeString (),
        ));

        // Institution Moderator role
        Role::create (array (
            'id'         => '2',
            'name'       => 'moderator',
            'label'      => 'Institutions-Verwalter',
            'created_at' => Carbon::now ()->toDateTimeString (),
        ));

        // Establish basic relationships
        // *****************************

        // Teacher for courses, moderator for courses AND institutions


    }
}
