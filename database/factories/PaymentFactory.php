<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Payment::class, function (Faker $faker) {
    return [
        'business_id' => 1,
        'invoice_id' => 1,
        'tracking' => Str::random(16),
        'approved' => $faker->boolean(),
        'amount' => $faker->randomFloat()
    ];
});
