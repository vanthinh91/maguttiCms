<?php


namespace App\maguttiCms\Domain\Store\Contracts;


use App\Cart;

interface PaymentProcessor
{
    function __construct(Cart $cart);
    function process();

}