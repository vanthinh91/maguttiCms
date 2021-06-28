<?php

namespace App\maguttiCms\Domain\Store\View\Components;

use App\Article;
use App\maguttiCms\Website\Facades\StoreHelper;
use Illuminate\View\View;
use Illuminate\Support\Collection;

use App\ShipmentMethod;

/**
 * Class ShopBannerComponent
 * @package App\maguttiCms\Domain\Store\View\Components
 */
class ShopBannerComponent  extends CartBaseStepComponent
{
    /**
     *  CMS SLUG PAGE FOR SHOP_BANNER
     *  CONTENT
     */
    const SHOP_BANNER_SLUG = "shop-banner";
    public $banner;

    public function __construct()
    {
        $this->banner= Article::getByTranslationSlug(self::SHOP_BANNER_SLUG);
    }

    public function render():View
    {
        return view('magutti_store::cart.shop_banner');;
    }

}
