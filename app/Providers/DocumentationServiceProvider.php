<?php

namespace App\Providers;

use App\Contracts\Documentation\Extractor;
use App\Contracts\Documentation\Reader;
use App\Documentation\ExtractorProvider;
use Illuminate\Support\ServiceProvider;
use Minime\Annotations\Cache\ArrayCache;
use Minime\Annotations\Interfaces\ReaderInterface;
use Minime\Annotations\Parser;

class DocumentationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ReaderInterface::class, function (){
            return new \Minime\Annotations\Reader(
                $this->app->make(Parser::class),
                $this->app->make( ArrayCache::class),
            );
        });

        $this->app->bind(Extractor::class, function (){
            return $this->app->make(ExtractorProvider::class);
        });

    }
}
