<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Record::class, function (Faker $faker) {
    return [
        'created_by_id' => 1,
        'provider_id' => 1,
        'business_id' => 1,
        'data' => $faker->text(200),
        'tracking' => \Str::random(16),
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstNameFemale,
        'last_name' => $faker->lastName,
        'dob' => $faker->date(),
        'ssn' => \Str::random(9)
    ];
});
