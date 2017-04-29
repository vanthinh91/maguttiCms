<?php namespace App\MaguttiCms\Filter;
use App\MaguttiCms\Filter\QueryFilters;

trait FilterableTrait
{

    public  function scopeFilter($query,QueryFilters $filters) {
       return $filters->apply($query);
    }


}

