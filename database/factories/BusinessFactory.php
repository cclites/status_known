<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Business::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'responsible_agent_id' => 1,
        'address_1' => $faker->streetAddress,
        'address_2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => $faker->postcode,
        'phone' => $faker->phoneNumber,
    ];
});
