<?php

use App\maguttiCms\Website\Controllers\Store\AddressStepController;
use App\maguttiCms\Website\Controllers\Store\ConfirmStepController;
use App\maguttiCms\Website\Controllers\Store\PaymentMethodStepController;

Route::get('/cart/', '\App\maguttiCms\Website\Controllers\StoreController@cart')->middleware('storeenabled');
Route::get('/cart/address', [AddressStepController::class,'view'])->middleware('storeenabled');
Route::post('/cart/address',[AddressStepController::class,'store'])->middleware('storeenabled');
Route::get('/cart/payment', [PaymentMethodStepController::class,'view'])->middleware('storeenabled');
Route::post('/cart/payment',[PaymentMethodStepController::class,'store'])->middleware('storeenabled');
Route::get('/cart/resume',  [ConfirmStepController::class,'view'])->middleware('storeenabled');




Route::get('/order-login/', '\App\maguttiCms\Website\Controllers\StoreController@orderLogin')->middleware(['storeenabled']);
Route::get('/order-submit/', '\App\maguttiCms\Website\Controllers\StoreController@orderSubmit')->middleware(['storeenabled']);
Route::post('/order-submit/', '\App\maguttiCms\Website\Controllers\StoreController@orderCreate')->middleware(['storeenabled', 'auth']);
Route::get('/order-review/{token}', '\App\maguttiCms\Website\Controllers\StoreController@orderReview')->middleware(['storeenabled', 'auth']);
Route::post('/order-payment/', '\App\maguttiCms\Website\Controllers\StoreController@orderPayment')->middleware(['storeenabled', 'auth']);
Route::get('/order-payment-cancel/{token}', '\App\maguttiCms\Website\Controllers\StoreController@orderCancel')->middleware(['storeenabled', 'auth']);
Route::get('/order-payment-confirm/{token}', '\App\maguttiCms\Website\Controllers\StoreController@orderConfirm')->middleware(['storeenabled', 'auth']);
Route::get('/order-payment-result/{token}', '\App\maguttiCms\Website\Controllers\StoreController@orderResult')->middleware(['storeenabled', 'auth']);
