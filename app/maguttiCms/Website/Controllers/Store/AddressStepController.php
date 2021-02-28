<?php


namespace App\maguttiCms\Website\Controllers\Store;


use App\Country;

use App\maguttiCms\Domain\Store\Action\UpdateCartAddressAction;
use App\maguttiCms\Tools\StoreHelper;


class AddressStepController extends  CartStepController
{


    public function view() {
        $cart = $this->getCart();

        if($cart) {
            $countries = Country::list()->get();
            $payment_methods = StoreHelper::getPaymentMethods();
            return view('website.store.order', compact('cart', 'countries', 'payment_methods'));
        }
        return $this->handleMissingStep();
    }

    function store(AddressFormRequest $request){
         $cart = $this->getCart();;
         (new UpdateCartAddressAction($cart))->execute($request);
         return redirect(url_locale('/cart/payment'));
     }
}