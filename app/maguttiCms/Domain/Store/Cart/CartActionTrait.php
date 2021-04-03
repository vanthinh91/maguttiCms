<?php


namespace App\maguttiCms\Domain\Store\Cart;

/*
|--------------------------------------------------------------------------
|  Action
|--------------------------------------------------------------------------
*/

trait CartActionTrait
{


    function update_cart_address($address_field, $address_id)
    {
        $this->update([$address_field => $address_id]);
    }
}