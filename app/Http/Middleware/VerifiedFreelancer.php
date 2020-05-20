<?php

namespace App\Http\Middleware;

use App\Enum\User\Role;
use App\Factories\ResponseFactory;
use App\Models\Business;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class VerifiedFreelancer
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
        /** @var Business $business */
        $business = $request->get('business');
        $isFreelancer = $business->users()
            ->where('user_id', '=', $this->user->id)
            ->where('role_id', '=', Role::VERIFIED_FREELANCER)
            ->exists();

        if (!$isFreelancer) {
            return ResponseFactory::error(
                'You are not a verified freelancer.',
                null,
                403
            );
        }

        return $next($request);
    }
}
