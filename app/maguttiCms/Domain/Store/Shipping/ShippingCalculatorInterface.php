<?php


namespace App\maguttiCms\Domain\Store\Shipping;


use App\Cart;

interface ShippingCalculatorInterface
{

   function  getAmount();
   function  getCost(Cart $cart);
}