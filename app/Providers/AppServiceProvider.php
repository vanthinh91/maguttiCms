<?php namespace App\Providers;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

/*
 *  maguttiCms
 */
use DB;
use Event;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Model::preventLazyLoading(! app()->isProduction());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
