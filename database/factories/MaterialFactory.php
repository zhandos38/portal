<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Material;
use Faker\Generator as Faker;

$factory->define(Material::class, function (Faker $faker) {

    return [
        'semester_id' => $faker->word,
        'group_id' => $faker->word,
        'teacher_id' => $faker->word,
        'subject_id' => $faker->word,
        'library_id' => $faker->word,
        'title' => $faker->word,
        'description' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
