<?php


namespace App\maguttiCms\Domain\Store\Action;


use App\maguttiCms\Domain\Store\Contracts\ShippingCalculator;
use App\maguttiCms\Domain\Store\Shipping\ShippingCalculatorInterface;
use App\maguttiCms\Tools\StoreHelper;

class ShippingCostAction
{
    /**
     * @var Cart
     */
    private $cart;
    /**
     * @var ShippingCalculator
     */
    private $shippingCalculator;

    public function __construct(ShippingCalculator $shippingCalculator,$cart)
    {
        $this->cart = $cart;
        $this->shippingCalculator = $shippingCalculator;
    }

    function execute(){
        $this->cart->shipping_cost=$this->calculate();
        $this->cart->save();
    }

    function calculate(){
        if(StoreHelper::isShippingEnabled())  return $this->shippingCalculator->getCost($this->cart);
        return 0;
    }
}