<?php

namespace App\Providers;

use App\Contracts\Geolocation\Geolocation;
use App\Geolocation\GeolocationProvider;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class GeolocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Geolocation::class, function (){
            return new GeolocationProvider(new Client(['base_uri' => 'https://maps.googleapis.com/']));
        });
    }
}
