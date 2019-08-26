<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/



$factory->define(User::class, function (Faker $faker) {
    return [
        'user_name' => $faker->name,
        'birthdate' => $faker->date,
        'mobile' => $faker->randomNumber($nbDigits = 7),
        'email' => $faker->unique()->safeEmail,
        'lat' => 80,
        'lon' => 180 ,
        'city' => 'ccc',
        'qrcode' => 'dddd',
        'active' => true,
        'activation_token' => 'dddddddddd',
        'password' => '$2y$10$/m4VVcJdH0KW3MrBKQyzDOAx2npCXHp1Ucgo3.9rGh5NRXbqpypiG', // password
        'remember_token' => Str::random(10),
    ];
});
