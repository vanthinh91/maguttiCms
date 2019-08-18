<?php

namespace App\maguttiCms\Domain\Cart;


use App\maguttiCms\Tools\StoreHelper;

class CartVieModel
{
  public $cart;
  public $items;
  function __construct()
  {
      $this->cart  = StoreHelper::getSessionCart();
      $this->items = StoreHelper::getCartItems();
  }
}