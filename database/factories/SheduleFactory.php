<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Shedule;
use Faker\Generator as Faker;

$factory->define(Shedule::class, function (Faker $faker) {

    return [
        'semester_id' => $faker->word,
        'group_id' => $faker->word,
        'teacher_id' => $faker->word,
        'subject_id' => $faker->word,
        'lesson_id' => $faker->word,
        'day_id' => $faker->word,
        'start' => $faker->word,
        'end' => $faker->word,
        'cabinet' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
