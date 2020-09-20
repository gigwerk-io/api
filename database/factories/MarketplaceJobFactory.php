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
        'image_one' => $faker->randomElement([
            'https://blogs.massaudubon.org/yourgreatoutdoors/wp-content/uploads/sites/20/2012/08/Kristin-FrontYard-EarlySpring-Small-2.jpg',
            'https://thenewswheel.com/wp-content/uploads/2018/04/junk-yards-pay-most-for-cars-760x507.jpg',
            'https://www.simplemost.com/wp-content/uploads/2017/01/8320434990_4c84ea6e62_o-750x500.jpg'
        ]),
        'complete_before' => \Carbon\Carbon::tomorrow()->toDateTimeString(),
    ];
});
