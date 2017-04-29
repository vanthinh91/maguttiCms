<?php namespace App\MaguttiCms\Filter\Helper;
use App\MaguttiCms\Definition\Definition;
use Input;
trait DistanceFilterTrait
{
    protected $unit;

    function  getAroundLocation($latitude,$longitude,$distance,$unit='km'){

        $this->unit = strtolower( $unit );
        $location = self::newQuery();
        $factor   = $this->getUnitFactor();
        $data     = $location->select('*', \DB::raw('( '.$factor.' * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
                    ->where('is_active', '=', 1)
                    ->orderBy('distance')
                    ->having('distance', '<', $distance )
                    ->get();
        return $this->transformCollection($data);
    }

    function getUnitFactor(){
        return ($this->unit =='mi')? Definition::DISTANCE_FACTOR_MI : Definition::DISTANCE_FACTOR_KM ;
    }
}

