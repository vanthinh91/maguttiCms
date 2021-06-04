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
            $message= [
                'text'	=> __('store.order.discount.coupon_deleted'),
                'type'	=> 'success',
            ];
            return $this->setMsg($message)->responseSuccess()->apiResponse();
        }
        return $this->apiResponse();
    }
}