<?php


namespace App\maguttiCms\Domain\Store;


trait CartPresenter
{
    function getCountItemsAttribute(){

        return $this->cart_items()->count();

    }

    function getCartProductPrice(){

        return $this->cart_items()->count();

    }
}