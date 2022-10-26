<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MarketplaceJob;
use Faker\Generator as Faker;

$factory->define(MarketplaceJob::class, function (Faker $faker) {
    return [
        'category_id' => 1,
        'price' => $faker->numberBetween(10, 50),
        'description' => $faker->sentences(2, true),
        'status_id' => \App\Enum\Marketplace\Status::REQUESTED,
        'intensity_id' => \App\Enum\Marketplace\Intensity::HARD,
        'client_name' => $faker->name,
        'complete_before' => \Carbon\Carbon::tomorrow()->toDateTimeString(),
    ];
});
