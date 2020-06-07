<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use PDF;
use Illuminate\Support\Facades\Crypt;

class Record extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'ssn',
        'created_by_id',
        'provider_id',
        'business_id',
        'invoice_id',
        'amount',
        'data',
        'tracking'
    ];


    /********************************************************
     * RELATIONSHIPS
     ********************************************************/

    public function business(){
        return $this->belongsTo('\App\Business');
    }

    public function report(){
        return $this->hasOne('\App\Report', 'tracking', 'tracking');
    }

    public function provider(){
        return $this->hasOne('\App\Provider', 'id', 'provider_id');
    }

    public function invoice(){
        return $this->hasOne('\App\Invoice', 'tracking', 'tracking');
    }

    public function createdBy(){
        return $this->hasOne('\App\User', 'id', 'created_by_id');
    }

    /********************************************************
     * Print
     ********************************************************/

    public function print(){


        $this->load('business');

        $this->data = Crypt::decrypt($this->data);
        $this->ssn = Crypt::decrypt($this->ssn);
        $this->dob = Crypt::decrypt($this->dob);

        $record = $this;

        $pdf = PDF::loadView('print.print_record', compact('record'));
        return $pdf->download('test_record.pdf');
    }

    /********************************************************
     *  TEST DATA
     ********************************************************/

    public function testRecord(){

        $faker = Faker::create();

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
