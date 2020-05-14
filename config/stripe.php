<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Stripe Publishable Key
    |--------------------------------------------------------------------------
    |
    | The Stripe publishable key is generally used by the client side application
    | meant solely to identify your account with Stripe, they aren’t secret.
    | In other words, they can safely be published in places like your Stripe.js,
    | JavaScript code, or in an Android or iPhone app.
    |
    */

    'publishable' => env('STRIPE_PUBLISHABLE', null),

    /*
    |--------------------------------------------------------------------------
    | Stripe Secret Key
    |--------------------------------------------------------------------------
    |
    | The Stripe secret key is keys should be kept confidential and only stored
    | on our servers. They can perform any API request to Stripe without restriction.
    |
    */
    'secret' => env('STRIPE_SECRET', null),

    /*
    |--------------------------------------------------------------------------
    | Stripe Connect
    |--------------------------------------------------------------------------
    |
    | Connect is a powerful API and set of tools used to route payments between
    | a business, customers, and recipients who need to get paid.
    | It powers payments for business models like marketplaces and software platforms.
    |
    */
    'connect' => [

        /*
        |--------------------------------------------------------------------------
        | Using Connect with Standard accounts
        |--------------------------------------------------------------------------
        |
        | Connect is a powerful API and set of tools used to route payments between
        | a business, customers, and recipients who need to get paid.
        | It powers payments for business models like marketplaces and software platforms.
        |
        */
        'standard' => env('STRIPE_STANDARD_CONNECT_URL', null),

        /*
        |--------------------------------------------------------------------------
        | Using Connect with Express accounts
        |--------------------------------------------------------------------------
        |
        | With Express accounts, you can quickly onboard users so they can be paid immediately.
        | You can customize the branding of the Express onboarding flow and dashboard.
        |
        */
        'express' => env('STRIPE_EXPRESS_CONNECT_URL', null),

        /*
        |--------------------------------------------------------------------------
        | Connect Redirect URI
        |--------------------------------------------------------------------------
        |
        | After the user connects their existing or newly created account to your platform,
        | they are redirected back to your site, to the URL established as your platform’s
        | redirect_uri. You must specify the route.
        |
        */
        'redirect_uri' => env('STRIPE_REDIRECT_URI', null),

        /*
        |--------------------------------------------------------------------------
        | Client ID
        |--------------------------------------------------------------------------
        |
        | This is the platform's client ID provided by Stripe.
        |
        */
        'client_id' => env('STRIPE_CLIENT_ID', null)
    ]
];
