<?php
namespace App\maguttiCms\Domain\Project;

use App\maguttiCms\SeoTools\SeoPermalinkResolver;
use App\maguttiCms\Website\Facades\ImgHelper;
use Mcamara\LaravelLocalization\LaravelLocalization;

trait ProjectPresenter

{
    /*
    |--------------------------------------------------------------------------
    |  Seo & Meta
    |--------------------------------------------------------------------------
    */
    use SeoPermalinkResolver;

    public function getThumbImage() {
        return ImgHelper::get_cached($this->image, config('maguttiCms.image.small'));
    }
}
