<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserInfo;
use Faker\Generator as Faker;

$factory->define(UserInfo::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'firstName' => $faker->word,
        'lastName' => $faker->word,
        'middleName' => $faker->word,
        'address' => $faker->word,
        'phone' => $faker->word,
        'email' => $faker->word,
        'birthDay' => $faker->word,
        'gender' => $faker->word,
        'nationality' => $faker->word,
        'idCard' => $faker->word,
        'iin' => $faker->word,
        'cardNumber' => $faker->word,
        'citizen' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
