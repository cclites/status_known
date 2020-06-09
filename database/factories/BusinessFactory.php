<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(\App\Business::class, function (Faker $faker) {

    return [
        'name' => $faker->company,
        'responsible_agent_id' => 1,
        'email' => $faker->companyEmail,
        'api_token' => Hash::make(Str::random(32)),
    ];
});
