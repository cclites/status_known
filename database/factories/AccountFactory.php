<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Account::class, function (Faker $faker) {
    return [
        'business_id' => 999,
        'tracking' => \Str::random(16),
        'account_number' => $faker->bankAccountNumber,
        'card_number' => $faker->creditCardNumber,
        'account_name' => "Bob"
    ];
});
