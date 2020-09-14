<?php

namespace App\Http\Middleware;

use App\Factories\ResponseFactory;
use App\Models\Business;
use Closure;

class ApplicationExists
{
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

        $application = $business->applications()->with(['user.profile'])->where('id', '=', $request->id)->first();

        if(is_null($application)) {
            return ResponseFactory::error(
                'Application not found',
                null,
                404
            );
        }

        $request->attributes->set('application', $application);
        return $next($request);
    }
}
