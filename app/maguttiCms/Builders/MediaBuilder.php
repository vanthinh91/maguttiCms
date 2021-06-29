<?php

namespace App\maguttiCms\Builders;


class MediaBuilder extends MaguttiCmsBuilder
{


    public function Images()
    {
        return $this->where('collection_name', 'images');
    }

    public function Documents()
    {
        return $this->where('collection_name', 'docs');
    }
}
