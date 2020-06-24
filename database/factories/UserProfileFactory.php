<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'image' => $faker->randomElement([
            'https://randomuser.me/api/portraits/men/91.jpg',
            'https://randomuser.me/api/portraits/women/91.jpg',
            'https://randomuser.me/api/portraits/men/92.jpg',
            'https://randomuser.me/api/portraits/women/92.jpg',
            'https://randomuser.me/api/portraits/men/93.jpg',
            'https://randomuser.me/api/portraits/women/93.jpg',
            'https://randomuser.me/api/portraits/men/94.jpg',
            'https://randomuser.me/api/portraits/women/94.jpg',
            'https://randomuser.me/api/portraits/men/95.jpg',
            'https://randomuser.me/api/portraits/women/95.jpg',
            'https://randomuser.me/api/portraits/men/96.jpg',
            'https://randomuser.me/api/portraits/women/96.jpg',
            'https://randomuser.me/api/portraits/men/97.jpg',
            'https://randomuser.me/api/portraits/women/97.jpg',
            'https://randomuser.me/api/portraits/men/98.jpg',
            'https://randomuser.me/api/portraits/women/98.jpg',
        ]),
        'description' => $faker->sentence
    ];
});
