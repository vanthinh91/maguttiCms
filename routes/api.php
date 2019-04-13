<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*
|--------------------------------------------------------------------------
| API LOCALIZED
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'v1','middleware' =>'localone'], function () {

    Route::group(['prefix' => 'search'], function () {
        /** free willy search routes  */
        Route::get('/{model}',  '\App\MaguttiCms\Api\V1\Controllers\SearchController@lista');

    });

    Route::group(['prefix' => 'services'], function () {

        /** free willy  routes */
        Route::get('/{model}',           '\App\MaguttiCms\Api\V1\Controllers\ServicesController@modellist');
        Route::get('/{model}/tags/{tag}','\App\MaguttiCms\Api\V1\Controllers\ServicesController@getByTags');
        Route::get('/{model}/{id}',   '\App\MaguttiCms\Api\V1\Controllers\ServicesController@show');
        Route::put('/{model}/{id}',   '\App\MaguttiCms\Api\V1\Controllers\ServicesController@update');
        Route::post ('/{model}',      '\App\MaguttiCms\Api\V1\Controllers\ServicesController@create');
        Route::delete('/{model}/{id}','\App\MaguttiCms\Api\V1\Controllers\ServicesController@show');
        Route::delete('/{model}/{id}','\App\MaguttiCms\Api\V1\Controllers\ServicesController@delete');





    });


    Route::group(['prefix' => 'subscribe'], function () {
        /** free willy  routes */
        Route::post('/notifications',  '\App\MaguttiCms\Api\V1\Controllers\SubscribeController@subscribeNotification');

    });


});