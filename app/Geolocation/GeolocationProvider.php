<?php


namespace App\Geolocation;


use App\Contracts\Geolocation\Geolocation;
use GuzzleHttp\Client;

class GeolocationProvider implements Geolocation
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Using google maps, geo locate by address.
     *
     * @param array $address
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function geoLocate(array $address)
    {
        $address = join(" ", $address);
        $method = "GET";
        $path = "maps/api/geocode/json";
        $query = [
            'query' => [
                'address' => $address,
                'key' => config('location.google_maps.key')
            ]
        ];
        $req = $this->client->request($method, $path, $query);
        $data = json_decode($req->getBody()->getContents());
        return $data->results[0]->geometry->location;
    }

    /**
     * Distance between two points in miles.
     *
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @return float
     */
    public function calculateDistanceBetweenTwoPoints(float $lat1, float $lon1, float $lat2, float $lon2)
    {
        // distance between latitudes
        // and longitudes
        $dLat = ($lat2 - $lat1) *
            M_PI / 180.0;
        $dLon = ($lon2 - $lon1) *
            M_PI / 180.0;

        // convert to radians
        $lat1 = ($lat1) * M_PI / 180.0;
        $lat2 = ($lat2) * M_PI / 180.0;

        // apply formulae
        $a = pow(sin($dLat / 2), 2) +
            pow(sin($dLon / 2), 2) *
            cos($lat1) * cos($lat2);
        $rad = 6371;
        $c = 2 * asin(sqrt($a));
        return  round(($rad * $c)/1.609, 1);
    }


}
