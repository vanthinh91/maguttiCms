<?php


namespace App\maguttiCms\Domain\Store;


use App\maguttiCms\Tools\StoreHelper;
use Illuminate\Support\Str;

trait OrderNotificationPresenter
{


    function newOrderEmailSubject():string
    {

        return env('APP_NAME').' - '.__('store.order.order').' N. '.$this->reference;
    }


}