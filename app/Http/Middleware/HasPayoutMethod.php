<?php

namespace App\Http\Middleware;

use App\Factories\ResponseFactory;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class HasPayoutMethod
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|User
     */
    private $user;

    public function __construct(Guard $guard)
    {
        $this->user = $guard->user();
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
        if($this->user->payoutMethod()->count() < 1){
            return ResponseFactory::error(
                'You need to setup a payment method.'
            );
        }
        return $next($request);
    }
}
