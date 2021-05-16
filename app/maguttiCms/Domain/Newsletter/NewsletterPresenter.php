<?php


namespace App\maguttiCms\Domain\Newsletter;


trait NewsletterPresenter
{
    /**
     * @return string
     */
    function getCouponUrlAttribute(): string
    {
        return env('APP_URL').'?'.http_build_query(['coupon'=>$this->coupon_code]);
    }
}