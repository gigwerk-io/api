<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BusinessProfile;
use Faker\Generator as Faker;

$factory->define(BusinessProfile::class, function (Faker $faker) {
    return [
        'image' => 'https://gigwerk-disk.s3.amazonaws.com/first.png',
        'cover' => 'https://gigwerk-disk.s3.amazonaws.com/roch.jpg',
        'short_description' => $faker->sentence,
        'long_description' => $faker->paragraph,
        'primary_color' => $faker->hexColor,
        'secondary_color' => $faker->safeHexColor
    ];
});
