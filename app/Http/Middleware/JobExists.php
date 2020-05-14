<?php

namespace App\Http\Middleware;

use App\Contracts\Repositories\MarketplaceJobRepository;
use App\Factories\ResponseFactory;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class JobExists
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|User
     */
    private $user;

    private $marketplaceJobRepository;

    public function __construct(Guard $guard, MarketplaceJobRepository $marketplaceJobRepository)
    {
        $this->user = $guard->user();
        $this->marketplaceJobRepository = $marketplaceJobRepository;
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
        $marketplaceJob = $this->marketplaceJobRepository->find($request->id);

        if(is_null($marketplaceJob)){
            return ResponseFactory::error(
                'This job was not found.',
                null,
                404
            );
        }

        $request->attributes->add(['job' => $marketplaceJob]);

        return $next($request);
    }
}
