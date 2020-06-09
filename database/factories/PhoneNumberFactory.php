<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PhoneNumber;
use Faker\Generator as Faker;

$factory->define(PhoneNumber::class, function (Faker $faker) {

    $types = ['Primary', 'Secondary', 'Emergency'];
    $typeIndex = array_rand($types);
    $type = $types[$typeIndex];

    return [
        'type'=> $type,
        'number'=> $faker->phoneNumber,
        'extension' => '',
        'contact_name'=>$faker->name('male')
    ];
});
