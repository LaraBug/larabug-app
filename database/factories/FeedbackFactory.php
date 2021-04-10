<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Feedback::class, function (Faker $faker) {
    return [
        'exception_id' => factory(\App\Models\Exception::class),
        'name' => $faker->name,
        'email' => $faker->email,
        'feedback' => $faker->sentence
    ];
});
