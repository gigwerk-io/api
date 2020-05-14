<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BusinessLocation;
use Faker\Generator as Faker;

$factory->define(BusinessLocation::class, function (Faker $faker) {
    return [
        'street_address' => $faker->streetAddress,
        'city' => 'Rochester',
        'state' => 'MN',
        'zip' => 55901,
        'lat' => 44.0446131,
        'long' => -92.48416069999999
    ];
});
