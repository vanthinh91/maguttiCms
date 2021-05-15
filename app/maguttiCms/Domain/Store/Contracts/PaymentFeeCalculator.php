<?php


namespace App\maguttiCms\Domain\Store\Contracts;



use App\PaymentMethod;

interface PaymentFeeCalculator
{
    function __construct(PaymentMethod $payment_method);
    function process();
}