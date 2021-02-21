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

    function addDiscount($code){

        return $this->update(['discount_code'=>$code]);

    }

    function removeDiscount(){
        return $this->update(['discount_code'=>null]);
    }

    function getDiscountAmountAttribute(){

        return optional($this->discount)->amount;

    }
    function getDiscountTypeAttribute(){

        return optional($this->discount)->type;

    }
}