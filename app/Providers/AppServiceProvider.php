<?php

namespace App\Providers;

use App\Calendar\CalendarProvider;
use App\Contracts\Calendar\Calendar;
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
                'accessType'   => 'offline'
            ]);
        });

        $this->app->bind(Calendar::class, CalendarProvider::class);
    }
}
