<?php

namespace App\Http\Middleware;

use App\Contracts\Repositories\BusinessRepository;
use App\Factories\ResponseFactory;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

class CanAccessBusiness
{
    /**
     * @var Authenticatable|User
     */
    private $user;

    /**
     * @var BusinessRepository
     */
    private $businessRepository;

    public function __construct(Guard $guard, BusinessRepository $businessRepository)
    {
        $this->user = $guard->user();
        $this->businessRepository = $businessRepository;
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
        $business = $this->businessRepository->findWhere(['unique_id' => $request->unique_id])->first();
        $hasAccess = $this->user->businesses()->where('business_id', '=', $business->id)->exists();

        if(!$hasAccess){
            return ResponseFactory::error('This area is forbidden.', null, 403);
        }

        $request->attributes->add(['business' => $business]);

        return $next($request);
    }
}
