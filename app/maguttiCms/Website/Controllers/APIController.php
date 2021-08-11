<?php

namespace App\maguttiCms\Website\Controllers;

use App\Discount;
use App\Http\Controllers\Controller;
use App\maguttiCms\Domain\Newsletter\Action\AddSubscriberAction;
use App\maguttiCms\Domain\Newsletter\Action\NotifyNewSubscriberAction;
use App\maguttiCms\Domain\Store\Action\CreateCouponAction;
use App\maguttiCms\Notifications\ContactRequest;
use App\maguttiCms\Notifications\NewsletterSubscriberAdminNotification;
use App\maguttiCms\Notifications\NewsletterSubscribeUserNotification;
use App\maguttiCms\Tools\JsonResponseTrait;
use App\maguttiCms\Website\Requests\AjaxFormRequest;
use Illuminate\Support\Facades\Notification;
use Input;
use Validator;
use App\Newsletter;

class APIController extends Controller
{

    use JsonResponseTrait;

    /**
     * @return mixed
     */
    public function subscribeNewsletter(AjaxFormRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());

        $attributes_bag=[];
        $attributes_bag['email']=$request->email;
        $attributes_bag['locale']=app()->getLocale();

        $coupon_code = (new CreateCouponAction(Discount::AMOUNT,10))->execute();
        $attributes_bag['coupon_code']=$coupon_code;

        $newsletter = (new AddSubscriberAction($attributes_bag))->execute();

        (new NotifyNewSubscriberAction($newsletter))->execute();

        return $this->responseSuccess(trans('website.mail_message.subscribe_newsletter_feedback'))->apiResponse();

    }

}
