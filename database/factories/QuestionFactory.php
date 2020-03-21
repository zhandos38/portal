<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {

    return [
        'quiz_id' => $faker->word,
        'question' => $faker->word,
        'A' => $faker->word,
        'B' => $faker->word,
        'C' => $faker->word,
        'D' => $faker->word,
        'E' => $faker->word,
        'Correct' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
