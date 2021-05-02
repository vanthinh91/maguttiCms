<?php


namespace App\maguttiCms\Domain\Store\Controllers\Payment;


use App\Cart;
use App\maguttiCms\Domain\Store\Action\CreateOrderAction;
use App\maguttiCms\Domain\Store\Contracts\PaymentProcessor;
use App\maguttiCms\Tools\StoreHelper;
use App\Order;

class BankTransfer implements PaymentProcessor
{

    /**
     * @var Cart
     */
    private $cart;
    private $order;

    function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    function process() : Order
    {
        $this->order = $this->createOrder();
        if($this->order){
            StoreHelper::createPayment($this->order->id, $this->cart->payment_method_id);
            return $this->order;
        }

        return false;

    }

    function createOrder()
    {
        return (new CreateOrderAction($this->cart))->execute();
    }
}