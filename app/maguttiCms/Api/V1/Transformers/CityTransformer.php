<?php namespace App\MaguttiCms\Api\V1\Transformers;

use App\City;
use League\Fractal;


class CityTransformer extends Fractal\TransformerAbstract
{
    public function transform(City $city)
    {
        return [
            'id'                => (int) $city->id,
            "country_code"      => $city->country_code,
            "name"              => $city->name,
            "description"       => "",
            "image_url"         => ma_get_image_from_repository_if_exists($city->image),
            "cover_image_url"   => ma_get_image_from_repository_if_exists($city->cover_image),
            "is_active"         => $city->is_active,
            "lang"              => app()->getLocale(),

        ];
    }
}