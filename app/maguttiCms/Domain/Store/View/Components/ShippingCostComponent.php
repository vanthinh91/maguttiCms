<?php

namespace App\maguttiCms\Domain\Store\View\Components;

use Illuminate\View\View;
use Illuminate\Support\Collection;

use App\ShipmentMethod;

/**
 * Class ShippingMethodComponent
 * @package App\maguttiCms\Domain\Store\View\Components
 */
class ShippingCostComponent  extends CartBaseStepComponent
{
    public $cart;

    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    public function render():View
    {
        return view('magutti_store::cart.shipping_method');;
    }

    public function shipping_methods():Collection
    {
        return ShipmentMethod::listed()->get();
    }
}
