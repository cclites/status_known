<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Provider::class, function (Faker $faker) {
    return [
        'contact_name' => $faker->name,
        'company_name' => $faker->lastName . " % Co.",
        'provider_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
    ];
});
