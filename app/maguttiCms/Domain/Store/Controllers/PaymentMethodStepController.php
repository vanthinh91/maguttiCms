<?php


namespace App\maguttiCms\Domain\Store\Controllers;



use App\Country;
use App\maguttiCms\Tools\StoreHelper;
use App\maguttiCms\Domain\Store\Action\ShippingCostAction;
use App\maguttiCms\Domain\Store\Shipping\StandardShippingCostCalculator;




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
            return view('magutti_store::cart.step_payment_and_shipping_methods', compact('cart','countries','payment_methods'));
        }
        return $this->handleMissingStep();

    }

    function store(PaymentMethodFormRequest $request){
         $cart = $this->getCart();
         $cart->add_payment_and_shipment($request->only('shipping_method_id','payment_method_id'));

         return redirect(url_locale('/cart/resume'));
     }
}