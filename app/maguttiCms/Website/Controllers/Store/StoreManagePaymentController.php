<?php


namespace App\maguttiCms\Website\Controllers\Store;


use App\Http\Controllers\Controller;
use App\LaraCms\Tools\StoreHelper;
use App\LaraCms\Website\Requests\WebsiteFormRequest;

class StoreManagePaymentController extends Controller
{


    public function orderPaymentManage(WebsiteFormRequest $request)
    {

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
                $order = StoreHelper::orderCreate($cart);
                $payment = StoreHelper::paymentCreate($order->id, $request->payment_method_id);

                return Redirect::to(url_locale('/order-confirm/'.$order->token));
                break;

            case '3': //cash
                $order = StoreHelper::orderCreate($cart);
                $payment = StoreHelper::paymentCreate($order->id, $request->payment_method_id);

                return Redirect::to(url_locale('/order-confirm/'.$order->token));
                break;
        }

    }
}
