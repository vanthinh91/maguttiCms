<?php


namespace App\maguttiCms\Domain\Store\Contracts;


use App\Cart;

interface PaymentFeeCalculator
{
    function __construct(Cart $cart);
    function process();
}