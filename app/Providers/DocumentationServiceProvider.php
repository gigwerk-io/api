<?php

namespace App\Providers;

use App\Contracts\Documentation\Documentation;
use App\Contracts\Documentation\Extractor;
use App\Contracts\Documentation\Reader;
use App\Contracts\Documentation\StringBlade;
use App\Contracts\Documentation\Writer;
use App\Documentation\DocumentationProvider;
use App\Documentation\ExtractorProvider;
use App\Documentation\StringBladeProvider;
use App\Documentation\WriterProvider;
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
//        $this->app->bind(ReaderInterface::class, function (){
//            return new \Minime\Annotations\Reader(
//                $this->app->make(Parser::class),
//                $this->app->make( ArrayCache::class),
//            );
//        });
//
//        $this->app->bind(Extractor::class, function (){
//            return $this->app->make(ExtractorProvider::class);
//        });
//
//        $this->app->bind(Documentation::class, function (){
//            return $this->app->make(DocumentationProvider::class);
//        });
//
//        $this->app->bind(StringBlade::class, function (){
//            return $this->app->make(StringBladeProvider::class);
//        });
//
//        $this->app->bind(Writer::class, function (){
//            return $this->app->make(WriterProvider::class);
//        });

    }
}
