<?php


namespace App\maguttiCms\Domain\Store\Support;


use App\maguttiCms\Tools\StoreHelper;

trait AddCartToUserAfterLogin
{
    function addCartToLoggedUser($user){

        request()->session()->regenerate();

        if (StoreHelper::isStoreEnabled()) {
            // if the user has an active cart, store it to the new session
            $cart = StoreHelper::getSessionCart();
            if ($cart) {
                $cart->user()->associate($user);
                $cart->save();
            }
            else {
               $cart = StoreHelper::getUserCart();
            }
            if ($cart) StoreHelper::setSessionCart($cart);
        }
    }
}