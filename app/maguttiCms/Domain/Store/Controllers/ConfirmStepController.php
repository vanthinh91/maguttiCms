<?php


namespace App\maguttiCms\Domain\Store\Controllers;


use App\Cart;
use App\Country;
use App\maguttiCms\Tools\StoreHelper;


class ConfirmStepController extends  CartStepController
{


    public function view()
    {
        $cart = $this->getCart();
        if(optional($cart)->hasStep()) {
            $result = $cart->calculate_shipping_cost();
            if($this->shippingHasError($result)){
                session()->flash('message', __('store.alerts.shipping_address_invalid',['ERROR'=>$result['message']]));
                return redirect(url_locale('/cart/address'));
            }

            $countries = Country::list()->get();
            $payment_methods = StoreHelper::getPaymentMethods();
            return view('magutti_store::cart.step_confirm_order', compact('cart', 'countries', 'payment_methods'));
        }
        return $this->handleMissingStep();

    }

    public function cancel(Cart $cart)
    {

        if(optional($cart)->hasStep()) {
            $countries = Country::list()->get();
            $payment_methods = StoreHelper::getPaymentMethods();
            return view('magutti_store::cart.step_confirm_order', compact('cart', 'countries', 'payment_methods'));
        }
        return $this->handleMissingStep();
    }
}
