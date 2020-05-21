<?php

namespace App\Http\Middleware;

use App\Factories\ResponseFactory;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

class BusinessOwner
{
    /**
     * @var Authenticatable|User
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
        $business = $request->get('business');
        if($business->owner_id != $this->user->id) {
            return ResponseFactory::error('This area is forbidden.', null, 403);
        }
        return $next($request);
    }
}
