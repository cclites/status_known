<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

use \Illuminate\Support\Facades\Crypt;

$factory->define(\App\Record::class, function (Faker $faker) {

    $data = [
        'addresses' => [
            [
            'address_1' => $faker->streetAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode
            ],
            [
                'address_1' => $faker->streetAddress,
                'city' => $faker->city,
                'state' => $faker->state,
                'zip' => $faker->postcode
            ],
            [
                'address_1' => $faker->streetAddress,
                'city' => $faker->city,
                'state' => $faker->state,
                'zip' => $faker->postcode
            ],
        ],
        'driving' => [
            [
                'date' => $faker->year,
                'county' => $faker->firstNameFemale,
                'state' => $faker->state,
                'violation' => $faker->text(25)
            ],
            [
                'date' => $faker->year,
                'county' => $faker->firstNameFemale,
                'state' => $faker->state,
                'violation' => $faker->text(25)
            ],
            [
                'date' => $faker->year,
                'county' => $faker->firstNameFemale,
                'state' => $faker->state,
                'violation' => $faker->text(25)
            ],
        ],
        'criminal' => [
            [
                'date' => $faker->year,
                'county' => $faker->firstNameFemale,
                'state' => $faker->state,
                'violation' => $faker->text(50),
                'disposition' => $faker->text(45),
            ],
            [
                'date' => $faker->year,
                'county' => $faker->firstNameFemale,
                'state' => $faker->state,
                'violation' => $faker->text(50),
                'disposition' => $faker->text(45),
            ],
            [
                'date' => $faker->year,
                'county' => $faker->firstNameFemale,
                'state' => $faker->state,
                'violation' => $faker->text(50),
                'disposition' => $faker->text(45),
            ],
        ]
    ];

    return [
        'created_by_id' => 999,
        'provider_id' => 999,
        'business_id' => 999,
        'data' => Crypt::encrypt( json_encode($data) ),
        'tracking' => $faker->password, //Possibly was going to use this to seed the encryption
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstNameFemale,
        'last_name' => $faker->lastName,
        'dob' => Crypt::encrypt($faker->date()),
        'ssn' => Crypt::encrypt($faker->ssn),
        'amount' => number_format( $faker->randomFloat(2, 20, 100) , 2),
    ];
});
