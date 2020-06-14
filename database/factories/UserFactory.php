<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => \Str::random(10) . "@mail.com",
        'email_verified_at' => now(),
        'password' => \Hash::make('test'),
        'remember_token' => \Str::random(10),
        'business_id' => 999
    ];
});
