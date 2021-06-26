<?php


namespace App\maguttiCms\Domain\Media;


use App\maguttiCms\Website\Facades\ImgHelper;

trait MediaPresenter
{
    public function getPreviewAttribute()
    {
        return ma_get_image_from_repository( $this->file_name);
    }


    public function getPreviewThumbAttribute()
    {
        return  ($this->file_name)? ImgHelper::get_cached($this->file_name, config('maguttiCms.image.admin')):'';
    }

    public function getCategoryAttribute()
    {
       return optional($this->media_category)->title;
    }

}