<?php

namespace App\maguttiCms\Domain\Block;

trait Blockable
{
    public function blocks()
    {
        return $this->morphMany('App\Block', 'model');
    }
}