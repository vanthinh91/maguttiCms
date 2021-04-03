<?php


namespace App\maguttiCms\Domain\Store\Action;


use App\maguttiCms\Domain\Store\Shipping\CustomShippingCostCalculator;
use App\maguttiCms\Domain\Store\Shipping\ShippingCalculatorInterface;
use App\maguttiCms\Domain\Store\Shipping\StandardShippingCostCalculator;
use App\maguttiCms\Tools\StoreHelper;

class ShippingCostResolverAction
{
    /**
     * @var Cart
     */
    private $cart;


    public function __construct($cart)
    {
        $this->cart = $cart;

    }

    function execute()
    {
        if (config('maguttiCms.store.shipping.use_service')) {
            //TODO add your shipingcost calculator here
            (new ShippingCostAction(new CustomShippingCostCalculator,$this->cart))->execute();
        }
        return (new ShippingCostAction(new StandardShippingCostCalculator,$this->cart))->execute();
    }

}