<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubjectList;
use Faker\Generator as Faker;

$factory->define(SubjectList::class, function (Faker $faker) {

    return [
        'semester_id' => $faker->word,
        'group_id' => $faker->word,
        'subject_id' => $faker->word,
        'student_id' => $faker->word,
        'credits' => $faker->word,
        'ECTS' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
