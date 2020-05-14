<?php


namespace App\Contracts\Geolocation;


interface Geolocation
{
    /**
     * Using google maps, geo locate by address.
     *
     * @param array $address
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function geoLocate(array $address);

    /**
     * Distance between two points in miles.
     *
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @return float
     */
    public function calculateDistanceBetweenTwoPoints(float $lat1, float $lon1, float $lat2, float $lon2);
}
