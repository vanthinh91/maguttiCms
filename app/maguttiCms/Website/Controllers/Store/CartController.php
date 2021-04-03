<?php


namespace App\maguttiCms\Website\Controllers\Store;


use App\Http\Controllers\Controller;
use App\maguttiCms\Domain\Cart\CartVieModel;

class CartController extends Controller
{
    public function __invoke()
    {

        $cart = new CartVieModel();
        return view('magutti_store::cart.detail', compact('cart',));

    }
}