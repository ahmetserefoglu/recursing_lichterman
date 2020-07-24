<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use AhmetSerefoglu\RecursingLichterman\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'publisher' => $faker->publisher,
        'author' => $faker->author,
        'year' => $faker->year,
        'isbn' => $faker->isbn
    ];
});
