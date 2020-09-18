<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ApplicationEvent;
use Faker\Generator as Faker;

$factory->define(ApplicationEvent::class, function (Faker $faker) {
    return [
        'event_type' => \App\Enums\ApplicationEventType::getRandomValue(),
        'start_time' => \Carbon\Carbon::tomorrow(),
        'end_time' => \Carbon\Carbon::tomorrow()->addHour(),
        'timezone' => $faker->timezone,
        'notes' => $faker->sentence,
    ];
});
