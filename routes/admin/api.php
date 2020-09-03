<?php

use App\maguttiCms\Middleware\AdminRole;
use App\maguttiCms\Middleware\AdminSuggestRole;

Route::group([], function () {
    /*
    |--------------------------------------------------------------------------
    | MEDIA LIBRARY
    |--------------------------------------------------------------------------
    */
    Route::post('uploadifiveSingle/',                    '\App\maguttiCms\Admin\Controllers\AjaxController@uploadifiveSingle');
    Route::post('uploadifiveMedia/',                    '\App\maguttiCms\Admin\Controllers\AjaxController@uploadifiveMedia');
    Route::post('cropperMedia/',                    '\App\maguttiCms\Admin\Controllers\AjaxController@cropperMedia');
    Route::get('updateHtml/media/{model?}','\App\maguttiCms\Admin\Controllers\AjaxController@updateModelMediaList');
    Route::get('updateHtml/{mediaType?}/{model?}/{id?}','\App\maguttiCms\Admin\Controllers\AjaxController@updateMediaList');
    Route::get('updateMediaSortList/',                  '\App\maguttiCms\Admin\Controllers\AjaxController@updateMediaSortList');
    Route::post('upload-media-tinymce/', '\App\maguttiCms\Admin\Controllers\AjaxController@uploadMediaTinyMCE');

    /*
    |--------------------------------------------------------------------------
    | API LIBRARY
    |--------------------------------------------------------------------------
    */

    Route::get('api/suggest', ['as' => 'api.suggest', 'uses' => '\App\maguttiCms\Admin\Controllers\SuggestAjaxController@suggest'])->middleware(AdminSuggestRole::class);
    Route::get('dashboard','\App\maguttiCms\Api\V1\Controllers\AdminServicesController@dashboard');
    Route::get('nav-bar','\App\maguttiCms\Api\V1\Controllers\AdminServicesController@navbar');
    Route::post('create/{model}','\App\maguttiCms\Api\V1\Controllers\AdminCrudController@create');
    Route::post('update/{model}/{id}','\App\maguttiCms\Api\V1\Controllers\AdminVrudController@update');

    /*
    |--------------------------------------------------------------------------
    | API SERVICES LIBRARY
    |--------------------------------------------------------------------------
    */

    Route::post('services/generator','\App\maguttiCms\Api\V1\Controllers\AdminServicesController@generator');
    /*
    |--------------------------------------------------------------------------
    | FILE MANANGER
    |--------------------------------------------------------------------------
    */
    Route::post('filemanager/upload', '\App\maguttiCms\Admin\Controllers\AjaxController@uploadFileManager');
    Route::get('filemanager/list/{id?}', '\App\maguttiCms\Admin\Controllers\AjaxController@getFileManagerList');
    Route::get('filemanager/edit/{id}', '\App\maguttiCms\Admin\Controllers\AjaxController@editFileManager');
    Route::post('filemanager/edit/{id}', '\App\maguttiCms\Admin\Controllers\AjaxController@updateFileManager');

    /*
    |--------------------------------------------------------------------------
    | CRUD LIBRARY
    |--------------------------------------------------------------------------
    */
    Route::post('create/{model}',                '\App\maguttiCms\Api\V1\Controllers\AdminCrudController@create');
    Route::post('update/{model}/{id}',           '\App\maguttiCms\Api\V1\Controllers\AdminCrudController@update');
    Route::get('update/{method}/{model?}/{id?}', '\App\maguttiCms\Admin\Controllers\AjaxController@update');
    Route::get('delete/{model?}/{id?}',          '\App\maguttiCms\Admin\Controllers\AjaxController@delete');

});
