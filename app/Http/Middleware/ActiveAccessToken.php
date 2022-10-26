<?php

namespace App\Http\Middleware;

use App\Factories\ResponseFactory;
use Carbon\Carbon;
use Closure;
use League\OAuth2\Client\Grant\RefreshToken;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Google;

class ActiveAccessToken
{
    /**
     * @var Google
     */
    private $google;

    public function __construct(Google $google)
    {
        $this->google = $google;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $business = $request->get('business');

        // Create a new access token if the old one happened to expire.
        if (!is_null($business->integration->google_expiration) && Carbon::parse($business->integration->google_expiration)->isPast()) {
            $grant = new RefreshToken();
            try {
                $token = $this->google->getAccessToken($grant, ['refresh_token' => $business->integration->google_refresh_token]);
                $business->integration()->update(['google_access_token' => $token->getToken()]);
            }catch (IdentityProviderException $exception) {
                return ResponseFactory::error($exception->getMessage());
            }

        }
        return $next($request);
    }
}
