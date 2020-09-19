<?php


/*
|--------------------------------------------------------------------------
| FRONT END API
|--------------------------------------------------------------------------
*/

use App\maguttiCms\Website\Controllers\PagesController;

Route::group([],function () {
	Route::post('api/update-ghost',		'\App\maguttiCms\Website\Controllers\APIController@updateGhost');

	// store section
	Route::post('api/store/cart-item-add',		'\App\maguttiCms\Website\Controllers\StoreAPIController@storeCartItemAdd');
	Route::post('api/store/cart-item-remove',	'\App\maguttiCms\Website\Controllers\StoreAPIController@storeCartitemRemove');
    Route::post('api/store/cart-item-update',	'\App\maguttiCms\Website\Controllers\StoreAPIController@updateItemQuantity');
	Route::get('api/store/order-calc',		'\App\maguttiCms\Website\Controllers\StoreAPIController@storeOrderCalc');
	Route::get('api/store/order-discount',	'\App\maguttiCms\Website\Controllers\StoreAPIController@storeOrderDiscount');
});

/*
|--------------------------------------------------------------------------
| FRONT END
|--------------------------------------------------------------------------
*/
Route::group([
   'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'usercart']
], function () {
	// Api
	Route::post('/api/newsletter',	'\App\maguttiCms\Website\Controllers\APIController@subscribeNewsletter');

    // Authentication routes...
    Route::get('users/login', '\App\maguttiCms\Website\Controllers\Auth\LoginController@showLoginForm')->name('users/login');
    Route::post('users/login','\App\maguttiCms\Website\Controllers\Auth\LoginController@login');
    Route::get('users/logout','\App\maguttiCms\Website\Controllers\Auth\LoginController@logout');

	// Reserved area user routes
	Route::group(['middleware' => ['auth']], function () {
	    Route::get('users/dashboard',    '\App\maguttiCms\Website\Controllers\ReservedAreaController@dashboard');
		Route::get('users/address-new',    '\App\maguttiCms\Website\Controllers\ReservedAreaController@addressNew');
		Route::post('users/address-new',    '\App\maguttiCms\Website\Controllers\ReservedAreaController@addressCreate');
	    Route::get('users/profile','\App\maguttiCms\Website\Controllers\ReservedAreaController@profile');
	});

    // Registration routes...
    Route::get('/register', '\App\maguttiCms\Website\Controllers\Auth\RegisterController@showRegistrationForm');
    Route::post('/register','\App\maguttiCms\Website\Controllers\Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset',        '\App\maguttiCms\Website\Controllers\Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email',       '\App\maguttiCms\Website\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}','\App\maguttiCms\Website\Controllers\Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset',       '\App\maguttiCms\Website\Controllers\Auth\ResetPasswordController@reset');

    // Pages routes...
    Route::get('/',                     '\App\maguttiCms\Website\Controllers\PagesController@home');
    Route::get('/news/',                '\App\maguttiCms\Website\Controllers\PagesController@news');
    Route::get('/news/tags/{tags}',     '\App\maguttiCms\Website\Controllers\PagesController@newsByTags');
    Route::get('/news/{slug}',          '\App\maguttiCms\Website\Controllers\PagesController@news');

    Route::get('/faq/',                [PagesController::class,'faq']);
    Route::get('/faq/{slug}',          '\App\maguttiCms\Website\Controllers\PagesController@news');



    Route::get(LaravelLocalization::transRoute("routes.category"),	'\App\maguttiCms\Website\Controllers\ProductsController@category');
    Route::get(LaravelLocalization::transRoute("routes.products"),	'\App\maguttiCms\Website\Controllers\ProductsController@products');
	Route::get(LaravelLocalization::transRoute("routes.contacts"),	'\App\maguttiCms\Website\Controllers\PagesController@contacts');
    Route::post('/contacts/',		    '\App\maguttiCms\Website\Controllers\WebsiteFormController@getContactUsForm');

	Route::get('/cart/',				'\App\maguttiCms\Website\Controllers\StoreController@cart')->middleware('storeenabled');
	Route::get('/order-login/',		    '\App\maguttiCms\Website\Controllers\StoreController@orderLogin')->middleware(['storeenabled']);
	Route::get('/order-submit/',		'\App\maguttiCms\Website\Controllers\StoreController@orderSubmit')->middleware(['storeenabled']);
	Route::post('/order-submit/',		'\App\maguttiCms\Website\Controllers\StoreController@orderCreate')->middleware(['storeenabled', 'auth']);
	Route::get('/order-review/{token}',	'\App\maguttiCms\Website\Controllers\StoreController@orderReview')->middleware(['storeenabled', 'auth']);
	Route::post('/order-payment/',		'\App\maguttiCms\Website\Controllers\StoreController@orderPayment')->middleware(['storeenabled', 'auth']);
	Route::get('/order-payment-cancel/{token}',	'\App\maguttiCms\Website\Controllers\StoreController@orderCancel')->middleware(['storeenabled', 'auth']);
	Route::get('/order-payment-confirm/{token}','\App\maguttiCms\Website\Controllers\StoreController@orderConfirm')->middleware(['storeenabled', 'auth']);
	Route::get('/order-payment-result/{token}',	'\App\maguttiCms\Website\Controllers\StoreController@orderResult')->middleware(['storeenabled', 'auth']);

    Route::name('seolanding')->group(base_path('routes/frontend/seolanding.php'));

    Route::get('/{parent}/{child}', '\App\maguttiCms\Website\Controllers\PagesController@pages');
    Route::get('/{parent?}/', '\App\maguttiCms\Website\Controllers\PagesController@pages');
});
