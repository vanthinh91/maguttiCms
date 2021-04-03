<?php


namespace App\maguttiCms\Domain\Store\Api;


use App\maguttiCms\Tools\StoreHelper;

class CouponDeleteController extends StoreAPIController
{
    public function __invoke()
    {
        $cart = StoreHelper::getSessionCart();
        if ($cart) {
            $cart->removeDiscount();
            return $this->responseSuccess()->apiResponse();
        }
        return $this->apiResponse();
    }
}