<?php

namespace App\maguttiCms\Domain\Store\Api;

use Illuminate\Support\Facades\Auth;

use App\Order;
use App\maguttiCms\Tools\JsonResponseTrait;
use App\maguttiCms\Website\Requests\AjaxFormRequest;
use App\maguttiCms\Website\Controllers\APIController;
use App\maguttiCms\Domain\Store\Facades\StoreFeatures;
use App\maguttiCms\Domain\Store\Controllers\OrderControllers;
use App\maguttiCms\Domain\Store\Notifications\NewOrderNotification;

/*
|--------------------------------------------------------------------------
| SET METHODS FOR AJAX STORE REQUESTS
|--------------------------------------------------------------------------
*/

/**
 * Class StoreAPIController
 * @package App\maguttiCms\Domain\Store\Api
 */
class ResendOrderNotification extends APIController
{
    public function __invoke(Order $order)
    {
        $user = Auth::user();

        if ($order->user_id == $user->id) {

            $user->notify(new NewOrderNotification($order,false));

            $message= [
                'text'	=> __('store.notification.order_resent'),
                'type'	=> 'success',
            ];

            return $this->setMsg($message)->responseSuccess()->apiResponse();
        }

        return $this->apiResponse();
    }
}
