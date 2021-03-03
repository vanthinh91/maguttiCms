<?php


namespace App\maguttiCms\Website\Controllers\Store;


use App\maguttiCms\Tools\StoreHelper;
use Illuminate\Support\Facades\Redirect;

class OrderManageController
{


    function handle(){

        $cart = StoreHelper::getSessionCart();


        switch ($cart->payment_method_id) {
            case '1': // paypal
                $response = StoreHelper::processPayment('paypal');
                if ($response['status'] == 'ok') {
                    return redirect($response['text']);
                }
                else {
                    // $order = $payment->order;
                    // session()->flash('error', $response['text']);
                    // return Redirect::to(url_locale('/order-payment-result/'.$order->token));
                }
                break;
            case '2': //bonifico
                $order = StoreHelper::createOrder($cart);
                $payment = StoreHelper::createPayment($order->id, $cart->payment_method_id);

                return Redirect::to(url_locale('/order-confirm/'.$order->token));
                break;

            case '3': //cash
                $order = StoreHelper::createOrder($cart);
                $payment = StoreHelper::createPayment($order->id, $cart->payment_method_id);
                return Redirect::to(url_locale('/order-confirm/'.$order->token));
                break;
        }

    }


}
