<?php


namespace App\maguttiCms\Website\Controllers;


use App\maguttiCms\Tools\StoreHelper;
use App\maguttiCms\Website\Requests\AjaxFormRequest;

class StoreValidateCouponController extends APIController
{
    public function __invoke(AjaxformRequest $request)
    {

        $discount = StoreHelper::getDiscount($request->code);
        if ($discount) {
            $cart =  StoreHelper::getSessionCart();
            if($cart) {
                $cart->addDiscount($request->code);
                $msg = sprintf(trans('store.order.discount.valid'), $discount->label);
                return $this->responseSuccess($msg)->apiResponse();
            }
        }

        $msg = trans('store.order.discount.invalid');
        return $this->responseWithError($msg)->apiResponse();
    }

    function addDiscountToCart(){


    }
}