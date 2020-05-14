<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserSavedLocation;
use Faker\Generator as Faker;

$factory->define(UserSavedLocation::class, function (Faker $faker) {
    return [
        'street_address' => $faker->streetAddress,
        'city' => 'Rochester',
        'state' => 'MN',
        'zip' => 55901,
        'lat' => 44.0446131,
        'long' => -92.48416069999999
    ];
});
