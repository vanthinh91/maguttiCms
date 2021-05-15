<?php

namespace App\maguttiCms\Domain\Store\View\Components;

use App\PaymentMethod;
use Illuminate\View\View;



/**
 * Class PaymentFeeComponent
 * @package App\maguttiCms\Domain\Store\View\Components
 */
class PaymentFeeComponent  extends CartBaseStepComponent
{
    public $payment_method;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->payment_method = $paymentMethod;
    }

    public function render():View
    {
        return view('magutti_store::cart.payment_fee');
    }


}
