<?php

namespace App\maguttiCms\Middleware;

use Closure;
use App\maguttiCms\Domain\Store\Facades\StoreFeatures;
use Illuminate\Support\Facades\Redirect;

class StoreEnabled
{
    public function __construct() {}

    public function handle($request, Closure $next) {
		if (StoreFeatures::isStoreEnabled())
			return $next($request);
		else
			return Redirect::to('/');
    }
}
