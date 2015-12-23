<?php

use \App\User;
use \App\Institution;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/**
 * Model Factory for Users
 */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->email,
        'address' => $faker->streetAddress(),
        'city' => $faker->city(),
        'zip' => $faker->postcode(),
        'country' => $faker->country(),
        'password' => bcrypt(str_random(10)),
        'isAdmin' => 0,
        'remember_token' => str_random(10),
    ];
});

/**
 * Model Factory for Courses
 */
$factory->define(App\Course::class, function (Faker\Generator $faker) {
    return [

        'assignedOwner' => User::orderByRaw("RAND()")->first()->id,
        'assignedInstitution' => Institution::orderByRaw("RAND()")->first()->id,
        'courseName' => $faker->sentence(4),
        'description' => $faker->text(250),
        'price' => $faker->randomNumber(4),
        'startDate' => $faker->dateTimeBetween('now', '+3 years'),
        'duration' => $faker->randomNumber(1),
        'created_at' => $faker->dateTime($max = 'now'),
        'confirmed' => 0,
        'participantNum' => 20,
    ];
});

/**
 * Model Factory for Institutions
 */
$factory->define(App\Institution::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company(),
        'slug' => $faker->word(),
        'address' => $faker->streetAddress(),
        'city' => $faker->city(),
        'zip' => $faker->postcode(),
        'country' => $faker->country(),
        'created_at' => $faker->dateTime($max = 'now'),
    ];
});