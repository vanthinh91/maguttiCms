<?php namespace App\MaguttiCms\Filter;
/**
 * Created by PhpStorm.
 * User: Marco Asperti
 * Date: 26/02/2017
 * Time: 10:47
 */
class CountryFilters extends QueryFilters
{
    protected function sorted ($order='ASC') {
        return $this->builder->orderBy('id',$order);
    }
}