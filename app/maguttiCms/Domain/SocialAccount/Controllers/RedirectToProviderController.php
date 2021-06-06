<?php

namespace App\maguttiCms\Domain\SocialAccount\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class RedirectToProviderController extends Controller
{

    public function __invoke($provider,Request $request)
    {

        if($request->has('redirectTo')){
            $request->session()->put('redirectToAfterSocialLogin', $request->get('redirectTo'));
        }
        else $request->session()->forget('redirectToAfterSocialLogin');

        return Socialite::driver($provider)->redirect();
    }
}
