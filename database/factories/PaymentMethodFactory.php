<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PaymentMethod;
use Faker\Generator as Faker;

$factory->define(PaymentMethod::class, function (Faker $faker) {
    return [
        'stripe_customer_id' => 'cus_FsQcawWaxlmfbs',
        'stripe_card_id' => 'card_1FMflHD2YnIDoaEIqLthZhO8',
        'card_type' => 'Visa',
        'card_last4' => 4242,
        'exp_month' => 12,
        'exp_year' => 2023,
        'default' => true
    ];
});
