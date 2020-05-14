<?php

namespace App\Providers;

use App\Contracts\Stripe\Billing;
use App\Contracts\Stripe\Connect;
use App\Stripe\BillingProvider;
use App\Stripe\ConnectProvider;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class StripeServiceProvider extends ServiceProvider
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
        $this->app->singleton(Connect::class, function (){
            return new ConnectProvider(new Client(['base_uri' => 'https://connect.stripe.com/oauth/']), $this->app->make('redis'));
        });

        $this->app->bind(Billing::class, function (){
            return $this->app->make(BillingProvider::class);
        });
    }
}
