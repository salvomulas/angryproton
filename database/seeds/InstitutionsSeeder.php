<?php

use Illuminate\Database\Seeder;
use App\Institution;

class InstitutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        // Generates a number of random institutions
        factory (App\Institution::class, 50)->create ();

        // Generates institutions for illustration purposes
        DB::table ('institutions')->insert ([
            'name'    => 'Fachhochschule Nordwestschweiz',
            'slug'    => 'FHNW',
            'address' => 'Von-Roll Strasse 1',
            'city'    => 'Olten',
            'zip'     => '4111',
            'country' => 'Switzerland',
        ]);
    }
}
