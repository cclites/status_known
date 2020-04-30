<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Report::class, function (Faker $faker) {
    return [
        'business_id' => 1,
        'tracking' => Str::random(16),
        'record_id' => 1,
        'requested_by_id' => 1
    ];
});
