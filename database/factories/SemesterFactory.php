<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Semester;
use Faker\Generator as Faker;

$factory->define(Semester::class, function (Faker $faker) {

    return [
        'year_id' => $faker->word,
        'title' => $faker->word,
        'start' => $faker->word,
        'end' => $faker->word,
        'current' => $faker->word,
        'step' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
