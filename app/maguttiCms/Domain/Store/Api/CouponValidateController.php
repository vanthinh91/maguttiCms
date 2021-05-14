<?php


namespace App\maguttiCms\Domain\Store\Api;


use App\Discount;
use App\maguttiCms\Tools\StoreHelper;
use App\maguttiCms\Website\Requests\AjaxFormRequest;

/**
 * Class CouponValidateController
 * @package App\maguttiCms\Domain\Store\Api
 * VALIDATE COUPON
 */
class CouponValidateController extends StoreAPIController
{
    public function __invoke(AjaxformRequest $request)
    {

        $discount = Discount::getByCode($request->code)->first();
        $cart = StoreHelper::getSessionCart();
        if (optional($discount)->checkDiscount()&& $cart) {
            $cart->addDiscount($request->code);
            $msg = sprintf(trans('store.order.discount.valid'), $discount->label);
            return $this->responseSuccess($msg)->apiResponse();
        }

        $msg = trans('store.order.discount.invalid');
        return $this->responseWithError($msg)->apiResponse();
    }

}