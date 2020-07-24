<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use AhmetSerefoglu\RecursingLichterman\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'publisher' => $faker->email
    ];
});
