<?php

namespace App\maguttiCms\Domain\SocialAccount\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

use App\maguttiCms\Domain\Store\Support\AddCartToUserAfterLogin;
use App\maguttiCms\Domain\SocialAccount\Action\FindOrCreateUserAction;
use App\maguttiCms\Domain\SocialAccount\Support\RedirectUserAfterLogin;

class SocialAuthController extends Controller
{
    use RedirectUserAfterLogin;
    use AddCartToUserAfterLogin;
    public function handleProviderCallback($provider)
    {

        try {
            $providerUser = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return redirect('/login');
        }
        $user = (new FindOrCreateUserAction())->handle($providerUser,$provider);
        $this->redirectTo = $this->getRedirectAfterLogin();
        Auth::login($user,true);
        $this->addCartToLoggedUser($user);
        return redirect($this->redirectTo);
    }

    /* TODO */
    public function reset($provider): string
    {
        return "ok";
    }
}
