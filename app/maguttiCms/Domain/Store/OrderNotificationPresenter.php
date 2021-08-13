<?php


namespace App\maguttiCms\Domain\Store;





trait OrderNotificationPresenter
{


    function newOrderEmailSubject():string
    {
        return env('APP_NAME').' - '.__('store.order.order').' N. '.$this->reference;
    }

}