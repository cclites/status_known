<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Report::class, function (Faker $faker) {
    return [
        'business_id' => 999,
        'tracking' => Str::random(16),
        'record_id' => 999,
        'requested_by_id' => 999
    ];
});
