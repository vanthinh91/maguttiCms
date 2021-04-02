<?php

namespace App\maguttiCms\Domain\Store\View\Components;

use Illuminate\View\View;
use Illuminate\Support\Collection;

use App\ShipmentMethod;

/**
 * Class ShippingMethodComponent
 * @package App\maguttiCms\Domain\Store\View\Components
 */
class ShippingCostLabel  extends CartBaseStepComponent
{
    public $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;

    }

    public function render(): View
    {
        return view('magutti_store::partials.shipping_cost');
    }
}


