<?php


namespace App\maguttiCms\Domain\Store\Api;


use App\maguttiCms\Tools\StoreHelper;
use App\maguttiCms\Website\Requests\AjaxFormRequest;

class CouponValidateController extends StoreAPIController
{
    public function __invoke(AjaxformRequest $request)
    {

        $discount = StoreHelper::getDiscount($request->code);
        $cart = StoreHelper::getSessionCart();
        if ($discount && $cart) {
            $cart->addDiscount($request->code);
            $msg = sprintf(trans('store.order.discount.valid'), $discount->label);
            return $this->responseSuccess($msg)->apiResponse();
        }

        $msg = trans('store.order.discount.invalid');
        return $this->responseWithError($msg)->apiResponse();
    }

}