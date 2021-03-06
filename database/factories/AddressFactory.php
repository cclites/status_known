<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {

    $types = ['Primary', 'Secondary', 'Billing'];


    $typeIndex = array_rand($types);
    $type = $types[$typeIndex];

    return [
        'address_1'=> $faker->streetAddress,
        'address_2'=> $faker->secondaryAddress,
        'city'=> $faker->city,
        'state'=>$faker->state,
        'zip' => $faker->postcode,
        'type'=> $type
    ];
});
