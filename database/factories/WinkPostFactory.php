<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Wink\WinkPost;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(WinkPost::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'title' => $faker->title,
        'excerpt' => $faker->sentence,
        'slug' => $faker->slug,
        'body' => $faker->paragraph,
        'published' => true,
        'markdown' => true,
        'featured_image' => $faker->imageUrl(),
        'featured_image_caption' => $faker->sentence,
        'publish_date' => Carbon::now(),
    ];
});

