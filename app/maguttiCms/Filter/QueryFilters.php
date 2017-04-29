<?php

namespace App\MaguttiCms\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Marco Asperti
 * Date: 26/02/2017
 * Time: 10:47
 */
abstract class QueryFilters
{
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {

        $this->builder = $builder;
        foreach ($this->filter() as $name => $value) {

            if (method_exists($this,$name)) {
               call_user_func_array([$this,$name],array_filter([$this->clearInput($value)]));
            }
            else if ($this->isFilterable($name)) {
                $this->builder->where($name, '=', $this->clearInput($value));
            }
        }

        $this->sorted();

        $this->active();

        return $this->builder;
    }

    public function filter()
    {
        return $this->request->all();
    }


    public function isFilterable($name)
    {
        return (in_array($name, $this->builder->getModel()->getFillable())) ? true : false;
    }


    public function clearInput($value)
    {
        return trim($value);
    }

    protected function sorted ($order='DESC') {
       return $this->builder->orderBy('id',$order);
    }

    protected function active () {

    }
}