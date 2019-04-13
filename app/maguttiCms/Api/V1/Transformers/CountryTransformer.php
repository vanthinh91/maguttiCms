<?php namespace App\MaguttiCms\Api\V1\Transformers;
use App\Country;
use League\Fractal;

class CountryTransformer extends Fractal\TransformerAbstract
{
    public function transform(Country $country)
    {
        return [
            'id'            => (int) $country->id,
            'name'          => $country->name,
            'iso_code'      => $country->iso_code,
            'is_active'     => $country->is_active,
            'lang'          => app()->getLocale(),
        ];
    }
}