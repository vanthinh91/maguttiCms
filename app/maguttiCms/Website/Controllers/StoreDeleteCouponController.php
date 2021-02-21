<?php


namespace App\maguttiCms\Website\Controllers;


use App\maguttiCms\Tools\StoreHelper;


class StoreDeleteCouponController extends APIController
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