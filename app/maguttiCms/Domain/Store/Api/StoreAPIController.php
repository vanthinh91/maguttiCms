<?php

namespace App\maguttiCms\Domain\Store\Api;


use App\maguttiCms\Tools\JsonResponseTrait;
use App\maguttiCms\Domain\Store\Facades\StoreHelper;
use App\maguttiCms\Website\Requests\AjaxFormRequest;
use App\maguttiCms\Website\Controllers\APIController;

/*
|--------------------------------------------------------------------------
| SET METHODS FOR AJAX STORE REQUESTS
|--------------------------------------------------------------------------
*/

/**
 * Class StoreAPIController
 * @package App\maguttiCms\Domain\Store\Api
 */
class StoreAPIController extends APIController
{
	private array $response = [];
    use JsonResponseTrait;

	public function __construct() {}

	public function storeCartItemAdd(AjaxFormRequest $request)
	{
		$result = StoreHelper::cartItemAdd($request->only('product_code','quantity','product_model'));
		if ($result) {
			$message= [
				'text'	=> trans('store.alerts.add_success'),
				'type'	=> 'success',
				'time'	=> 3
			];
            $this->setData($result)->responseSuccess();
   		}
		else {
            $message=  [
				'text'	=> trans('store.alerts.add_fail'),
				'type'	=> 'warning',
				'time'	=> 5
			];
		}
        return $this->setMsg($message)->apiResponse();
	}


    public function updateItemQuantity(AjaxFormRequest $request)
    {
        $result = StoreHelper::updateItemQuantity($request->only('id','quantity'));
        if ($result) {
            $message= [
                'text'	=> trans('store.alerts.add_success'),
                'type'	=> 'success',
                'time'	=> 3
            ];
            $this->setData($result)->responseSuccess();
        }
        else {
            $message=  [
                'text'	=> trans('store.alerts.add_fail'),
                'type'	=> 'warning',
                'time'	=> 5
            ];
        }
        return $this->setMsg($message)->apiResponse();
    }

	public function storeCartItemRemove(AjaxFormRequest $request)
	{
	    $result = StoreHelper::cartItemRemove($request->id);
		if ($result) {
			$message= [
				'text'	=> trans('store.alerts.remove_success'),
				'type'	=> 'success',
				'time'	=> 3
			];
            $this->setData($result)->responseSuccess();
		}
		else {
			$message=[
				'text'	=> trans('store.alerts.remove_fail'),
				'type'	=> 'warning',
				'time'	=> 5
			];
		}
        return $this->setMsg($message)->apiResponse();
	}
}
