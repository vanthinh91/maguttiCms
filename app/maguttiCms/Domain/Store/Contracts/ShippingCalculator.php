<?php


namespace App\maguttiCms\Domain\Store\Contracts;


use App\Cart;

interface ShippingCalculator
{

   function  getAmount();
   function  getCost(Cart $cart);
}