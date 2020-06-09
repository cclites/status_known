<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PhoneNumber;
use Faker\Generator as Faker;

$factory->define(PhoneNumber::class, function (Faker $faker) {
    return [
        'type'=> array_rand(['Primary', 'Secondary', 'Emergency']),
        'number'=> $faker->phoneNumber,
        'extension' => '',
        'contact_name'=>$faker->name('male')
    ];
});
