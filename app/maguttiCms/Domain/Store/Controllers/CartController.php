<?php


namespace App\maguttiCms\Domain\Store\Controllers;


use App\Http\Controllers\Controller;
use App\maguttiCms\Domain\Store\Cart\CartVieModel;

class CartController extends Controller
{
    public function __invoke()
    {
        $cart = new CartVieModel();
        return view('magutti_store::cart.detail', compact('cart',));
    }
}