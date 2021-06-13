<?php


/*
|--------------------------------------------------------------------------
| FRONT END API
|--------------------------------------------------------------------------
*/


use App\maguttiCms\Domain\Store\Controllers\OrderControllers;
use App\maguttiCms\Website\Controllers\APIController;
use App\maguttiCms\Website\Controllers\Auth\ForgotPasswordController;
use App\maguttiCms\Website\Controllers\Auth\LoginController;
use App\maguttiCms\Website\Controllers\Auth\RegisterController;
use App\maguttiCms\Website\Controllers\Auth\ResetPasswordController;
use App\maguttiCms\Website\Controllers\PagesController;
use App\maguttiCms\Website\Controllers\ProductsController;
use App\maguttiCms\Website\Controllers\ReservedAreaController;
use App\maguttiCms\Website\Controllers\StoreAPIController;

use App\maguttiCms\Website\Controllers\UpdatePasswordController;
use App\maguttiCms\Website\Controllers\WebsiteFormController;

/*
|--------------------------------------------------------------------------
| FRONT END
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'usercart']], function () {
    // Api
    Route::post('/api/newsletter', [APIController::class, 'subscribeNewsletter']);

    // Authentication routes...
    Route::get('users/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('users/login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');;

    // Reserved area user routes
    Route::group(['middleware' => ['auth']], function () {
        Route::get('users/dashboard', [ReservedAreaController::class, 'dashboard'])->name('user.dashboard');
        Route::get('users/profile', [ReservedAreaController::class, 'profile'])->name('user.profile');
        Route::post('users/profile', [ReservedAreaController::class, 'update_profile']);
        Route::post('users/change-password', [UpdatePasswordController::class, 'update_password'])->name('user.change-password');
        Route::get('users/order-detail/{order}', [OrderControllers::class, 'show'])->name('order.detail');

        Route::get('users/address-new', [ReservedAreaController::class, 'addressNew']);
        Route::post('users/address-new', [ReservedAreaController::class, 'addressCreate']);
    });

    // Registration routes...
    Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
    Route::post('/register', [RegisterController::class, 'register']);

    // Password Reset Routes...
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm']);
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    // Pages routes...
    Route::get('/', [PagesController::class, 'home']);
    Route::get('/news/', [PagesController::class, 'news']);
    Route::get('/news/tags/{tags}', [PagesController::class, 'newsByTags']);
    Route::get('/news/{slug}', [PagesController::class, 'news']);
    Route::get('/faq/', [PagesController::class, 'faq']);
    Route::get('/faq/{slug}', [PagesController::class, 'faq']);

    Route::get(LaravelLocalization::transRoute("routes.category"), [ProductsController::class, 'category'])->name('shop.index');
    Route::get(LaravelLocalization::transRoute("routes.products"), [ProductsController::class, 'products']);
    Route::get(LaravelLocalization::transRoute("routes.contacts"), [PagesController::class, 'contacts']);

    Route::post('/contacts/', [WebsiteFormController::class, 'getContactUsForm']);

    // store page
    Route::group(['as'=>'store.'],base_path('routes/frontend/store.php'));

    // store social_auth
    Route::group(['as'=>'social_auth.'],base_path('routes/frontend/social_auth.php'));

    //Route::name('seolanding')->group(base_path('routes/frontend/seolanding.php'));

    Route::get('/{parent}/{child}', [PagesController::class, 'pages']);
    Route::get('/{parent?}/', [PagesController::class, 'pages']);
});
