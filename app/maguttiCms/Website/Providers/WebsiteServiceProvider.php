<?php

namespace App\maguttiCms\Website\Providers;
Use App;
use Illuminate\Support\ServiceProvider;

class WebsiteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      App::bind('HtmlHelper', function() {return new \App\maguttiCms\Tools\HtmlHelper;});
      App::bind('StoreHelper', function() {return new \App\maguttiCms\Domain\Store\StoreHelper;});
      App::bind('ImgHelper', function() {return new \App\maguttiCms\Tools\ImgHelper;});
      App::bind('SeoLandingHelper', function() {return new \App\maguttiCms\SeoTools\SeoLandingHelper;});
    }
}
