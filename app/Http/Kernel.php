<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,


        /*
        |--------------------------------------------------------------------------
        | maguttiCms Middleware
        |--------------------------------------------------------------------------
        */

        //'Clockwork\Support\Laravel\ClockworkMiddleware',
        \App\maguttiCms\Middleware\ForceSSLMiddleware::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,


        /*
        |--------------------------------------------------------------------------
        | maguttiCms Middleware
        |--------------------------------------------------------------------------
        */

        'shield' => \App\maguttiCms\Middleware\GFShieldMiddleware::class,
        'adminauth' => \App\maguttiCms\Middleware\AdminAuthenticate::class,
        'localone'  => \App\MaguttiCms\Middleware\Localization::class,
		'storeenabled' => \App\maguttiCms\Middleware\StoreEnabled::class,
		'usercart' => \App\maguttiCms\Middleware\UserCart::class,
		'setlocaleadmin'  => \App\maguttiCms\Middleware\SetLocaleAdmin::class,
        'adminimpersonate'  => \App\maguttiCms\Middleware\AdminImpersonate::class,

        /*
        |--------------------------------------------------------------------------
        | maguttiCms add-ons
        |--------------------------------------------------------------------------
        */

        /**** OTHER MIDDLEWARE ****/
        'localize'               => 'Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes',
        'localizationRedirect'   => 'Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter',
        'localeSessionRedirect'  => 'Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect',

        // REDIRECTION MIDDLEWARE
        'role'                  => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission'            => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability'               => \Zizaco\Entrust\Middleware\EntrustAbility::class,

    ];
    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
