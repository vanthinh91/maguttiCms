<?php

namespace App\maguttiCms\Builders;

use App\News;
use Carbon\Carbon;

class DomainBuilder extends MaguttiCmsBuilder
{

    public function byDomain($domain)    {
       return  $this->where('domain',$domain )->published();
    }


}
