<?php


namespace App\maguttiCms\Domain\SocialAccount\Support;



trait RedirectUserAfterLogin
{
    protected string $redirectTo = 'user.dashboard';// default redirect;

    function getRedirectAfterLogin(){
        if(request()->session()->has('redirectToAfterSocialLogin')){
            $this->redirectTo =  request()->session()->get('redirectToAfterSocialLogin');
        }

        request()->session()->forget('redirectToAfterSocialLogin');

        return $this->redirectTo;
    }
}