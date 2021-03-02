<?php

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/


Route::get('/services/{id?}', function ($id='') {
   $order = new \App\Order;
   $reference = $order->randomReference();
   dd($reference);
});


Route::prefix('admin')->group(base_path('routes/admin/index.php'));

/*
|--------------------------------------------------------------------------
| FRONT END ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix(LaravelLocalization::setLocale())->group(base_path('routes/frontend/index.php'));


/*
|--------------------------------------------------------------------------
| FALLBACK ROUTES
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return redirect(url_locale('/'));
});

