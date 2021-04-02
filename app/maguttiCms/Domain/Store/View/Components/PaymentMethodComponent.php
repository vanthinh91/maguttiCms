<?php

namespace App\maguttiCms\Domain\Store\View\Components;

use Illuminate\View\View;
use Illuminate\Support\Collection;


use App\PaymentMethod;

/**
 * Class PaymentMethodComponent
 * @package App\maguttiCms\Domain\Store\View\Components
 */
class PaymentMethodComponent extends CartBaseStepComponent
{

    public function render():View
    {
        return view('magutti_store::cart.payment_method');;
    }

    public function payment_methods():Collection
    {
        return PaymentMethod::listed()->get();
    }
}
