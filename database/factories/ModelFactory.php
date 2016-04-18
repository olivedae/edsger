<?php

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

$factory->define(App\User::class, function (Faker\Generator $faker) 
{
    $name = explode(' ', $faker->name);
    return [
        'first_name'      => $name[0],
        'last_name'       => $name[1],
        'email'           => $faker->email,
        'password'        => bcrypt('password'),
        'remember_token'  => str_random(10),
        'remember_me'     => $faker->boolean($chanceOfGettingRight = 90),
        'email_confirmed' => $faker->boolean($chanceOfGettingRight = 75)
    ];
});
