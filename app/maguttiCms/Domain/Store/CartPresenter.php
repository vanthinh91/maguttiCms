<?php


namespace App\maguttiCms\Domain\Store;


use App\maguttiCms\Tools\StoreHelper;
use Illuminate\Session\Store;

trait CartPresenter
{


    function isEmpty(){

        return $this->countItems<1;
    }


    function hasBillingAddress(){

        return $this->billing_address_id>0;
    }

    function getCountItemsAttribute()
    {

        return $this->cart_items()->count();

    }

    function getCartProductPrice()
    {
        return $this->cart_items()->count();
    }

    function addDiscount($code)
    {

        return $this->update(['discount_code' => $code]);

    }

    function removeDiscount()
    {
        return $this->update(['discount_code' => null]);
    }

    function getDiscountAmountAttribute()
    {

        return optional($this->discount)->amount;

    }

    function getDiscountTypeAttribute()
    {

        return optional($this->discount)->type;

    }

    function getDiscountTotalAmount(){

       return  (Storehelper::getDiscountAmount($this)) ?: 0;
    }

    function cartGrandTotal()
    {
        $product_total = $this->getTotalProducts();
        $discount_amount = $this->getDiscountTotalAmount();
        //dd(StoreHelper::calcShipping($this,20));
        return ($product_total - $discount_amount > 0) ? $product_total - $discount_amount : 0;
    }
    function getTotalProducts()
    {
        return  StoreHelper::getCartTotal($this);
    }

    function getShipping()
    {

        return null;
    }

    function getVat()
    {

        return null;
    }

    function getShipmentLastnameAttribute()
    {
        $lastname = (auth_user()) ? auth_user()->lastname : '';
        return data_get($this->shipping_address, 'lastname', $lastname);
    }

    function getShipmentFirstnameAttribute()
    {
        $firstname = (auth_user()) ? auth_user()->firstname : '';
        return data_get($this->shipping_address, 'firstname', $firstname);
    }

    function getShipmentEmailAttribute()
    {
        $email = (auth_user()) ? auth_user()->email : '';
        return data_get($this->shipping_address, 'email', $email);
    }

    function getBillingLastnameAttribute()
    {
        $lastname = (auth_user()) ? auth_user()->lastname : '';
        return data_get($this->billing_address, 'lastname', $lastname);
    }


    function getBillingFirstnameAttribute()
    {
        $firstname = (auth_user()) ? auth_user()->firstname : '';
        return data_get($this->billing_address, 'firstname', $firstname);
    }

    function getBillingEmailAttribute()
    {
        $email = (auth_user()) ? auth_user()->email : '';
        return data_get($this->billing_address, 'email', $email);
    }

    function prefillAddressIfPresent()
    {
       if(auth_user()){

           $latestOrder = optional(auth_user()->orders())->latest()->first();
           if($latestOrder){
                $this->shipping_address_id = $latestOrder->shipping_address_id;
                $this->save();
            };
       }
    }
}
