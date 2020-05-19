<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BusinessProfile;
use Faker\Generator as Faker;

$factory->define(BusinessProfile::class, function (Faker $faker) {
    return [
        'image' => 'http://507outdoormanagement.com/wp-content/uploads/2019/10/foliage-2942282_1920-1920x730.jpg',
        'cover' => 'http://507outdoormanagement.com/wp-content/uploads/2019/10/foliage-2942282_1920-1920x730.jpg',
        'short_description' => $faker->sentence,
        'long_description' => $faker->paragraph,
        'primary_color' => $faker->hexColor,
        'secondary_color' => $faker->safeHexColor
    ];
});
