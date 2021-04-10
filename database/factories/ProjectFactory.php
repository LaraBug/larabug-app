<?php

/** @var Factory $factory */

use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(
    Project::class,
    function (Faker $faker) {
        return [
        'title' => $faker->company,
        'description' => $faker->text(50),
        'url' => $faker->url,
        'key' => str_random(25)
    ];
    }
);
