<?php


namespace App\maguttiCms\Domain\Store\Payment;


use App\Cart;

use App\maguttiCms\Domain\Store\Contracts\PaymentFeeCalculator;
use App\PaymentMethod;

class StandardPaymentFeeCalculator implements PaymentFeeCalculator
{


    private PaymentMethod $payment_method;

    public function __construct(PaymentMethod $payment_method)
    {

        $this->payment_method = $payment_method;
    }

    function process()
    {
        return $this->calculateAmount();
    }

    protected function calculateAmount()
    {
        return optional($this->payment_method)->fee??0;
    }
}