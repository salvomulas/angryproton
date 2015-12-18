<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Calls the seeder in the correct order to populate the database with fake data
        $this->call(UsersSeeder::class);
        $this->call(InstitutionsSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(ACLSeeder::class);

        Model::reguard();
    }
}
