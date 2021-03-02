<?php


namespace App\maguttiCms\Domain\Store;




use App\maguttiCms\Definition\Definition;

trait CartStepTrait
{


    function hasStep()
    {
        if($this->isEmpty()) return false;
        $step = $this->getLastSegment();
        if ($step === Definition::CART_STEP_PAYMENT) {
            if (!$this->shipping_address_id) return false;
        }
        if ($step === Definition::CART_STEP_RESUME) {

            if (!$this->shipping_address_id || !$this->payment_method_id) return false;
        }
        return $step;

    }

    function getLastSegment()
    {
        return collect(request()->segments())->last();
    }

}