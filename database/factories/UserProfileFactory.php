<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'image' => $faker->randomElement([
            'https://i.picsum.photos/id/538/640/640.jpg',
            'https://i.picsum.photos/id/58/600/600.jpg',
            'https://i.picsum.photos/id/873/600/600.jpg',
            'https://i.picsum.photos/id/547/600/600.jpg',
            'https://i.picsum.photos/id/691/600/600.jpg',
            'https://i.picsum.photos/id/680/600/600.jpg',
            'https://i.picsum.photos/id/703/600/600.jpg',
            'https://i.picsum.photos/id/937/600/600.jpg',
            'https://i.picsum.photos/id/650/600/600.jpg',
            'https://i.picsum.photos/id/668/600/600.jpg',
            'https://i.picsum.photos/id/619/600/600.jpg',
            'https://i.picsum.photos/id/548/600/600.jpg',
            'https://i.picsum.photos/id/401/600/600.jpg',
            'https://i.picsum.photos/id/338/600/600.jpg',
            'https://i.picsum.photos/id/558/600/600.jpg',
            'https://i.picsum.photos/id/2/600/600.jpg',
            'https://i.picsum.photos/id/310/600/600.jpg',
            'https://i.picsum.photos/id/152/600/600.jpg',
            'https://i.picsum.photos/id/386/600/600.jpg',
            'https://i.picsum.photos/id/835/600/600.jpg',
            'https://i.picsum.photos/id/521/600/600.jpg',
            'https://i.picsum.photos/id/586/600/600.jpg',
            'https://i.picsum.photos/id/239/600/600.jpg',
            'https://i.picsum.photos/id/617/600/600.jpg',
            'https://i.picsum.photos/id/1019/600/600.jpg',
            'https://i.picsum.photos/id/435/600/600.jpg',
            'https://i.picsum.photos/id/239/600/600.jpg',
            'https://i.picsum.photos/id/145/600/600.jpg',
        ]),
        'description' => $faker->sentence
    ];
});
