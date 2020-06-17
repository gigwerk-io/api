<?php

namespace App\Http\Middleware;

use App\Factories\ResponseFactory;
use Closure;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Filesystem\Filesystem;

class BuilderAuthentication
{
    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Hasher $hasher, Filesystem $filesystem)
    {
        $this->hasher = $hasher;
        $this->filesystem = $filesystem;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle($request, Closure $next)
    {
        $bearerKey = $request->bearerToken();

        $hashedKey = $this->filesystem->get(base_path('builder.txt'));

        if (!$this->hasher->check($bearerKey, $hashedKey)) {
            return ResponseFactory::error('Access denied.', null, 403);
        }

        return $next($request);
    }
}
