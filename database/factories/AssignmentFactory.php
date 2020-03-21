<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Assignment;
use Faker\Generator as Faker;

$factory->define(Assignment::class, function (Faker $faker) {

    return [
        'semester_id' => $faker->word,
        'group_id' => $faker->word,
        'subject_id' => $faker->word,
        'teacher_id' => $faker->word,
        'student_id' => $faker->word,
        'first_rating' => $faker->word,
        'second_rating' => $faker->word,
        'exam_rating' => $faker->word,
        'total_rating' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
