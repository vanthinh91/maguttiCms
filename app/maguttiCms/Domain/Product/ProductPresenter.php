<?php
namespace App\maguttiCms\Domain\Product;

use App\maguttiCms\Website\Facades\ImgHelper;
use App\maguttiCms\SeoTools\SeoPermalinkResolver;

trait ProductPresenter

{
    /*
    |--------------------------------------------------------------------------
    |  Seo & Meta
    |--------------------------------------------------------------------------
    */
    use SeoPermalinkResolver;

    public function getInfoPermalink() {
        return url_locale('/contacts/?product_id='.$this->id);
    }
    public function getThumbImage() {
        return ImgHelper::init('products')->get_cached($this->image, config('maguttiCms.image.small'));
    }
}
