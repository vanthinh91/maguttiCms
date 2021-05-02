<?php
namespace App\maguttiCms\Domain\News;
use App\maguttiCms\Tools\StringHelper;

trait NewsPresenter
{

    /*
    |--------------------------------------------------------------------------
    |  This method return the news permalink.
    |--------------------------------------------------------------------------
    */
    public function getPermalink($locale='')
    {
        $locale = ($locale) ? $locale : app()->getLocale();
        return url_locale('news/'. $this->{'slug:'. $locale});
    }

    /*
    |--------------------------------------------------------------------------
    |  This method return the news excerpt.
    |--------------------------------------------------------------------------
    */
    public function getExcerpt($length = 200,$strip=false)
    {
        $description =($strip)?strip_tags($this->description):$this->description;
        return StringHelper::truncate($description,$length);
    }
}