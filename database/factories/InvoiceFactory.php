<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'business_id' => 999,
        'tracking' => Str::random(16),
        'amount' => $faker->randomFloat(3, 2),
    ];
});
