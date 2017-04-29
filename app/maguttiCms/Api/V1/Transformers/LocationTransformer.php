<?php namespace App\MaguttiCms\Api\V1\Transformers;

use App\Location;
use League\Fractal;


class LocationTransformer extends Fractal\TransformerAbstract
{
    public function transform(Location $location)
    {
        return [
            'id'                => (int) $location->id,
            "category_id"       => $location->category_id,
            "city_id"           => $location->city_id,
            "name"              => $location->name,
            //"intro"             => "",
            //"description"       => "",
            //"formatted_address" => $location->formatted_address,
            "latitude"          => $location->latitude,
            "longitude"         => $location->longitude ,
            "cover_image_url"   => ma_get_thumbnail_image($location->image),
            "image_url"         => ma_get_image_from_repository_if_exists($location->image),
            'lang'              => app()->getLocale(),
            //"telephone"         => (string) $location->telephone,
            //"website"           => $location->website,
            "is_active"         => $location->is_active,
            "distance"          => round($location->distance,1),
            "audio_size"        => $location->getAudioSize(),
            //'podcasts'          => $location->podcasts,
        ];
    }
}