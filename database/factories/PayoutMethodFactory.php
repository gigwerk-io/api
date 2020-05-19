<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PayoutMethod;
use Faker\Generator as Faker;

$factory->define(PayoutMethod::class, function (Faker $faker) {
    return [
        'stripe_connect_id' => 'acct_1DwaU9EzJAz0EYJ2'
    ];
});
