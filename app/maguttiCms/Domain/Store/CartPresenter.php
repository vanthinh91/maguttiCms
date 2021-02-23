<?php


namespace App\maguttiCms\Domain\Store;


use App\maguttiCms\Tools\StoreHelper;
use Illuminate\Session\Store;

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

    function cartGrandTotal(){

        $product_total =  StoreHelper::getCartTotal($this);
        $discount_amount = (Storehelper::getDiscountAmount($this))?:0;
        //dd(StoreHelper::calcShipping($this,20));
        return ($product_total-$discount_amount>0)?$product_total-$discount_amount:0;

    }
}