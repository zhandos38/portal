<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ExamSchedule;
use Faker\Generator as Faker;

$factory->define(ExamSchedule::class, function (Faker $faker) {

    return [
        'semester_id' => $faker->word,
        'subject_id' => $faker->word,
        'group_id' => $faker->word,
        'type_id' => $faker->word,
        'quiz_id' => $faker->word,
        'start' => $faker->word,
        'end' => $faker->word,
        'time' => $faker->word,
        'cabinet' => $faker->word,
        'active' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
