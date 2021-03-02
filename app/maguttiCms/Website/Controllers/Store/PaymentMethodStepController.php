<?php


namespace App\maguttiCms\Website\Controllers\Store;


use App\Country;

use App\maguttiCms\Domain\Store\Action\UpdateCartAddressAction;
use App\maguttiCms\Tools\StoreHelper;



class PaymentMethodStepController extends  CartStepController
{

     function autorize($ability, $arguments = [])
     {
         return false;
     }

    public function view() {

        $cart = $this->getCart();
        if(optional($cart)->hasStep()){
            $countries = Country::list()->get();
            $payment_methods = StoreHelper::getPaymentMethods();
            return view('website.store.step_payment_method', compact('cart','countries','payment_methods'));
        }

        return $this->handleMissingStep();

    }

    function store(PaymentMethodFormRequest $request){
         $cart = $this->getCart();
         $cart->update(['payment_method_id'=>$request->payment_method_id]);
         return redirect(url_locale('/cart/resume'));
     }
}