<?php

namespace App\maguttiCms\Domain\Store\Cart;


use App\maguttiCms\Domain\Store\Facades\StoreHelper;

class CartVieModel
{
  public $cart;
  public $items;
  function __construct()
  {
      $this->cart  = StoreHelper::getSessionCart();
      $this->items = StoreHelper::getCartItems();
  }


  function isEmpty(){
       return $this->items->isEmpty();
  }
}