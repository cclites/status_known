<?php
namespace database\factories;

use Faker\Generator as Faker;

class RecordDataFactory
{
    static function data(Faker $faker){

        $data = [
            'addresses' => [
                [
                    'address_1' => $faker->streetAddress,
                    'city' => $faker->city,
                    'state' => $faker->state,
                    'zip' => $faker->postcode,
                ],
                [
                    'address_1' => $faker->streetAddress,
                    'city' => $faker->city,
                    'state' => $faker->state,
                    'zip' => $faker->postcode,
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

        return $data;
    }
}
