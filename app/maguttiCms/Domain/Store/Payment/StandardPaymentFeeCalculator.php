<?php


namespace App\maguttiCms\Domain\Store\Payment;


use App\Cart;
use App\maguttiCms\Domain\Store\Contracts\PaymentFeeCalculator;

class StandardPaymentFeeCalculator implements PaymentFeeCalculator
{

    private Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    function process()
    {
        // TODO: Implement process() method.
    }
}