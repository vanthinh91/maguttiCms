<?php


namespace App\maguttiCms\Domain\Block;


trait BlockPresenter
{
    /**
     * This method is used to get button block title.
     *
     *
     * @return mixed
     */
    function getBtnTitleAttribute()
    {
        return ($this->btn_title) ? $this->btn_title : $this->subtitle;
    }
}
