<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserLastLocation;
use Faker\Generator as Faker;

$factory->define(UserLastLocation::class, function (Faker $faker) {
    return [
        'lat' => 44.0446131,
        'long' => -92.48416069999999
    ];
});
