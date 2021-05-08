<?php


namespace App\maguttiCms\Domain\Store\Contracts;


use App\Cart;

interface DiscountCalculator
{
    function __construct(Cart $cart);
    function process();
}