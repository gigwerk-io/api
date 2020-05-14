<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ChatMessage;
use Faker\Generator as Faker;

$factory->define(ChatMessage::class, function (Faker $faker) {
    return [
        'text' => $faker->sentences(2, true)
    ];
});
