<?php

namespace App\maguttiCms\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminImpersonate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       return (Auth::guard('admin')->user()->isSu() ) ? $next($request) : redirect('/admin');
    }
}
