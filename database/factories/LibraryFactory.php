<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Library;
use Faker\Generator as Faker;

$factory->define(Library::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'description' => $faker->word,
        'src' => $faker->word,
        'user_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
