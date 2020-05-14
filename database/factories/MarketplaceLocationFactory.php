<?php
$factory->define(\App\Models\MarketplaceLocation::class, function (Faker\Generator $faker){
    $gondaBuilding = [
        'street_address' => '200 1st St SW',
        'city' => 'Rochester',
        'state' => 'MN',
        'zip' => '55905',
        'lat' => 44.022430,
        'long' => -92.466751
    ];

    $mcDs = [
        'street_address' => '5500 Bandel Rd NW',
        'city' => 'Rochester',
        'state' => 'MN',
        'zip' => '55901',
        'lat' => 44.080270,
        'long' => -92.505040
    ];

    $mayoHigh = [
        'street_address' => '1420 11th Ave SE',
        'city' => 'Rochester',
        'state' => 'MN',
        'zip' => '55904',
        'lat' => 44.003899,
        'long' => -92.446198
    ];

    return $faker->randomElement([$gondaBuilding, $mcDs, $mayoHigh]);
});
