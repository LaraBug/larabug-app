<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Exception::class, function (Faker $faker) {
    return [
        'project_id' => factory(\App\Models\Project::class)
    ];
});
