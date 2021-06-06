<?php

use App\maguttiCms\Domain\SocialAccount\Controllers\SocialAuthController;
use App\maguttiCms\Domain\SocialAccount\Controllers\RedirectToProviderController;

Route::group([], function () {
    Route::get('social_auth/{provider}',          RedirectToProviderController::class);
    Route::get('social_auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);
    Route::get('social_auth/{provider}/reset',    [SocialAuthController::class, 'reset']);
});