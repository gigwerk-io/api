<?php

namespace App\Providers;

use App\Contracts\Image\Base64Image;
use App\Contracts\Image\ImageResize;
use App\Image\Base64ImageProvider;
use App\Image\ImageResizeProvider;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
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
        $this->app->bind(Base64Image::class, function (){
            return $this->app->make(Base64ImageProvider::class);
        });

        $this->app->bind(ImageResize::class, function (){
            return $this->app->make(ImageResizeProvider::class);
        });
    }
}
