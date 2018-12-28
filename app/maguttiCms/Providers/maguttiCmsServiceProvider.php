<?php namespace App\maguttiCms\Providers;

use App\Setting;
use Illuminate\Support\ServiceProvider;

/*
 *  maguttiCms
 */
use DB;
use Event;
use Validator;
/*
|--------------------------------------------------------------------------
| common maguttiCms service providers
|--------------------------------------------------------------------------
| here  will'be set all the common action
*/
class LaraServiceProvider extends ServiceProvider
{
    private $site_settings;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
          * GF_ma for maguttiCms
          * simple query debugger
          * use http://framework_base.dev/admin/list/articles?sql-debug=1
          */


        view()->composer('*', function($view){
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('view_name', $view_name);
        });



        view()->composer('website/*', function(){
            $this->site_settings = Setting::all()->pluck('value','key');
            view()->share('site_settings', $this->site_settings);
        });


        /*
         * GF_ma for maguttiCms
         * simple query debugger
         * use http://framework_base.dev/admin/list/articles?sql-debug=1
         */
        if (env('APP_ENV') === 'local') {
            DB::connection()->enableQueryLog();
        }
        if (env('APP_ENV') === 'local') {
            Event::listen('kernel.handled', function ($request, $response) {
                if ( $request->has('sql-debug') ) {
                    $queries = DB::getQueryLog();
                    dd($queries);
                }
            });
        }


        /*
        |--------------------------------------------------------------------------
        |  LARACMS VALIDATION CUSTOM DIRECTIVE
        |--------------------------------------------------------------------------
        */

        Validator::extend('is_unique', function($attribute, $value, $parameters, $validator) {

            $model  = request()->segment(3);
            $config = config('maguttiCms.admin.list.section.' .$model);
            $id     = (request()->segment(4))?:null;
            if(getModelFromString($config['model'])::where($attribute,$value)->where('id','!=',$id)->count()) return false;
            return true;
        });



        /*
        |--------------------------------------------------------------------------
        |  BLADE CUSTOM DIRECTIVE
        |--------------------------------------------------------------------------
        */
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
