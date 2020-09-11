<?php

namespace App\Providers;

use Google_Client;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use League\OAuth2\Client\Provider\Google;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment(['local', 'testing'])) {
            config(['app.disk' => 'public']);
        }
        $this->app->register(RepositoryServiceProvider::class);

        // Google Provider instance
        $this->app->singleton(Google::class, function ($app, $parameters){
            return new Google([
                'clientId'     => env('GOOGLE_CLIENT_ID'),
                'clientSecret' => env('GOOGLE_CLIENT_SECRET'),
                'redirectUri'  => route('generate.google.token'),
            ]);
        });

        // Dynamic Google Client for Calendar.
        $this->app->singleton(Google_Client::class, function ($app, $parameters){
            $client = new Google_Client();
            $client->setAccessToken($parameters['access_token']);
            return $client;
        });
    }
}
