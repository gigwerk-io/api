<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Business;
use Faker\Generator as Faker;

$factory->define(Business::class, function (Faker $faker) {
    return [
        'unique_id' => $faker->uuid,
        'name' => $faker->company,
        'subdomain_prefix' => $faker->domainWord,
        'stripe_connect_id' => 'acct_1F7RiLBKeAbZ6utM',
        'is_accepting_applications' => 1,
    ];
});
