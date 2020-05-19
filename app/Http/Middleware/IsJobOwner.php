<?php

namespace App\Http\Middleware;

use App\Factories\ResponseFactory;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

class IsJobOwner
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
        $job = $request->get('job');
        if($job->customer_id != $this->user->id){
            return ResponseFactory::error(
                'You are not the owner of this job!',
                null,
                403
            );
        }

        return $next($request);
    }
}
