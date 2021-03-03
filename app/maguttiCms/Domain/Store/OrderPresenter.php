<?php


namespace App\maguttiCms\Domain\Store;


use App\maguttiCms\Tools\StoreHelper;
use Illuminate\Support\Str;

trait OrderPresenter
{


    public function getProductsCostDisplayAttribute()
    {
        return StoreHelper::formatPrice($this->products_cost);
    }

    public function getShippingCostDisplayAttribute()
    {
        return StoreHelper::formatPrice($this->shipping_cost);
    }

    public function getVatCostDisplayAttribute()
    {
        return StoreHelper::formatPrice($this->vat_cost);
    }

    public function getTotalCostDisplayAttribute()
    {
        return StoreHelper::formatPrice($this->total_cost);
    }

    public function getOrderReferenceAttribute()
    {
        return $this->reference;
    }


    static public function generateReference(){

        $reference = strtoupper(Str::random(8));

        $validator = \Validator::make(['reference'=>$reference ],['id'=>'unique:orders,reference']);

        if($validator->fails()){
            return self::generateReference();
        }

        return $reference ;
    }


}