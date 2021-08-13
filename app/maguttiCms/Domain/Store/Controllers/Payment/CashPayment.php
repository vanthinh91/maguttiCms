<?php


namespace App\maguttiCms\Domain\Store\Controllers\Payment;


use App\Cart;
use App\Order;
use App\maguttiCms\Domain\Store\Facades\StoreHelper;
use App\maguttiCms\Domain\Store\Action\CreateOrderAction;
use App\maguttiCms\Domain\Store\Contracts\PaymentProcessor;

class CashPayment implements PaymentProcessor
{

    /**
     * @var Cart
     */
    private Cart $cart;

    function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    function process() : Order
    {
        $order = $this->createOrder();
        if($order){
            StoreHelper::createPayment($order->id, $this->cart->payment_method_id);
            return $order;
        }
        return false;
    }

    function createOrder()
    {
        return (new CreateOrderAction($this->cart))->execute();
    }
}