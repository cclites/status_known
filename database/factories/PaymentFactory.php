<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Payment::class, function (Faker $faker) {
    return [
        'business_id' => 999,
        'invoice_id' => 999,
        'tracking' => Str::random(16),
        'approved' => $faker->boolean(),
        'amount' => $faker->randomFloat()
    ];
});
