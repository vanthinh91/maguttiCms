<?php


namespace App\maguttiCms\Website\Controllers\Store;


use App\Country;

use App\maguttiCms\Domain\Store\Action\UpdateCartAddressAction;
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
}
