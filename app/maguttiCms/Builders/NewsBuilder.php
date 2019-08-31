<?php

namespace App\maguttiCms\Builders;

use Carbon\Carbon;

class NewsBuilder extends MaguttiCmsBuilder
{
    /**
     * @param int $limit
     * @return mixed
     */
    public function latestPublished($limit = 5)
    {
        return $this->published()->translatedContent()->latest('date')->limit($limit);
    }

    /**
     * @return MaguttiCmsBuilder|NewsBuilder
     */
    public function published()
    {
        return $this->where('pub', 1)->where('date', '<=', Carbon::now());
    }
    function findPublished()
    {

        return $this->published()
            ->latest('date');

    }
}
