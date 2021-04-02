<?php


namespace App\maguttiCms\Domain\Store\Controllers;


use App\Cart;
use App\Country;
use App\maguttiCms\Domain\Store\Action\ShippingCostAction;
use App\maguttiCms\Domain\Store\Shipping\StandardShippingCostCalculator;
use App\maguttiCms\Tools\StoreHelper;



class ConfirmStepController extends  CartStepController
{

    public function __construct()
    {

    }

    public function view()
    {
        $cart = $this->getCart();
        if(optional($cart)->hasStep()) {
            $countries = Country::list()->get();
            $payment_methods = StoreHelper::getPaymentMethods();

            return view('website.store.step_corfirm_order', compact('cart', 'countries', 'payment_methods'));
        }
        return $this->handleMissingStep();

    }

    public function cancel(Cart $cart)
    {

        if(optional($cart)->hasStep()) {
            session()->flash('message', trans('store.alerts.payment_cancel'));
            $countries = Country::list()->get();
            $payment_methods = StoreHelper::getPaymentMethods();
            return view('website.store.step_corfirm_order', compact('cart', 'countries', 'payment_methods'));
        }
        return $this->handleMissingStep();
    }
}
