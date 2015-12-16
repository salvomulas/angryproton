<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generates a number of random courses
        factory (App\Course::class, 50)->create ();
    }
}
