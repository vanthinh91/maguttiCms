<?php

/*
|--------------------------------------------------------------------------
| ADMIN Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\maguttiCms\Middleware\AdminDeleteRole;
use App\maguttiCms\Middleware\AdminEditRole;
use App\maguttiCms\Middleware\AdminRole;
use App\maguttiCms\Middleware\AdminStoreRole;

Route::group(['namespace' => 'Admin', 'middleware' => ['adminauth', 'setlocaleadmin']], function () {

    Route::get('/', '\App\maguttiCms\Admin\Controllers\AdminPagesController@home')->name('admin_dashboard');
    Route::get('/list/{section?}/{sub?}', '\App\maguttiCms\Admin\Controllers\AdminPagesController@lista')->middleware(AdminRole::class);
    Route::get('/view/{section}/{id?}/{type?}', '\App\maguttiCms\Admin\Controllers\AdminPagesController@view')->middleware(AdminRole::class);
    Route::get('/create/{section}', '\App\maguttiCms\Admin\Controllers\AdminPagesController@create')->middleware(AdminRole::class);
    Route::post('/create/{section}', '\App\maguttiCms\Admin\Controllers\AdminPagesController@store')->middleware(AdminStoreRole::class);

    Route::get('/edit/{section}/{id?}/{type?}', '\App\maguttiCms\Admin\Controllers\AdminPagesController@edit')->middleware(AdminEditRole::class)->name('admin_edit');
    Route::post('/edit/{section}/{id?}', '\App\maguttiCms\Admin\Controllers\AdminPagesController@update')->middleware(AdminStoreRole::class);

    Route::get('/file_view/{section}/{id}/{key}', '\App\maguttiCms\Admin\Controllers\AdminPagesController@file_view');

    Route::get('/editmodal/{section}/{id?}/{type?}', '\App\maguttiCms\Admin\Controllers\AdminPagesController@editmodal');
    Route::post('/editmodal/{section}/{id?}', '\App\maguttiCms\Admin\Controllers\AdminPagesController@updatemodal');
    Route::get('/delete/{section}/{id?}', '\App\maguttiCms\Admin\Controllers\AdminPagesController@destroy')->middleware(AdminDeleteRole::class);

    Route::get('/duplicate/{section}/{id?}/{type?}', '\App\maguttiCms\Admin\Controllers\AdminPagesController@duplicate');

    Route::group(array('prefix' => 'impersonated', 'middleware' => ['adminimpersonate']), function () {
        Route::get('/adminusers/{id?}', '\App\maguttiCms\Admin\Controllers\AdminImpersonateController@impersonateadmin');
        Route::get('/users/{id?}', '\App\maguttiCms\Admin\Controllers\AdminImpersonateController@impersonateuser');
    });

    /*
    |--------------------------------------------------------------------------
    | API
    |--------------------------------------------------------------------------
    */
    Route::prefix('api')->group(base_path('routes/admin/api.php'));

    Route::get('/exportlist/{section?}/{sub?}', '\App\maguttiCms\Admin\Controllers\AdminExportController@lista');
});
/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/
Route::group([], function () {

    Route::group(['middleware' => 'guest:admin'], function () {

        // Admin Auth and Password routes...
        Route::get('login', '\App\maguttiCms\Admin\Controllers\Auth\LoginController@showLoginForm');
        Route::post('login', '\App\maguttiCms\Admin\Controllers\Auth\LoginController@login');

        // Password Reset Routes...
        Route::get('password/reset', '\App\maguttiCms\Admin\Controllers\Auth\ForgotPasswordController@showLinkRequestForm');
        Route::post('password/email', '\App\maguttiCms\Admin\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/reset', '\App\maguttiCms\Admin\Controllers\Auth\ResetPasswordController@reset');
        Route::get('password/reset/{token}', '\App\maguttiCms\Admin\Controllers\Auth\ResetPasswordController@showResetForm');
    });

    Route::get('logout', '\App\maguttiCms\Admin\Controllers\Auth\LoginController@logout');
});

