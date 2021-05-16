<?php


namespace App\maguttiCms\Domain\Store\Discounts;


use App\maguttiCms\Builders\MaguttiCmsBuilder;

class DiscountBuilder extends MaguttiCmsBuilder
{
    /**
     * @param $code
     * @return MaguttiCmsBuilder
     */
    public function getByCode($code): MaguttiCmsBuilder
    {
        return $this->active()->where('code',strtoupper($code));
    }


}