<?php

use Illuminate\Http\Request;

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

    Route::group(['prefix' => 'services', 'middleware' => 'cors'], function () {
        /** free willy  routes */
        Route::get('/{model}',      '\App\MaguttiCms\Api\V1\Controllers\ServicesController@modellist');
        Route::get('/{model}/{id}', '\App\MaguttiCms\Api\V1\Controllers\ServicesController@show');
    });

});
