<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        // Generates a number of random users
        factory (App\User::class, 50)->create ();

        // Generates users for testing purposes
        DB::table ('users')->insert ([
            'firstName' => 'Max',
            'lastName'  => 'Mustermann',
            'email'     => 'user@angryproton.ch',
            'password'  => bcrypt ('secret'),
            'isAdmin'   => 0,
        ]);
        DB::table ('users')->insert ([
            'firstName' => 'Hans',
            'lastName'  => 'Dozent',
            'email'     => 'teacher@angryproton.ch',
            'password'  => bcrypt ('secret'),
            'isAdmin'   => 0,
        ]);
        DB::table ('users')->insert ([
            'firstName' => 'Gregor',
            'lastName'  => 'Schulleiter',
            'email'     => 'manager@angryproton.ch',
            'password'  => bcrypt ('secret'),
            'isAdmin'   => 0,
        ]);
        DB::table ('users')->insert ([
            'firstName' => 'Bob',
            'lastName'  => 'Gottkomplex',
            'email'     => 'root@angryproton.ch',
            'password'  => bcrypt ('secret'),
            'isAdmin'   => 1,
        ]);
    }
}
