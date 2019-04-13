<?php namespace App\MaguttiCms\Api\V1\Transformers;
use App\Podcast;
use League\Fractal;
class PodcastTransformer extends Fractal\TransformerAbstract
{

    public function transform(Podcast $podcast)
    {
        // TODO  will be  removedff;
        $podcast->podcast = 'audio/pino.mp3';

        return [
            'id'                => (int) $podcast->id,
            "location_id"       => $podcast->location_id,
            //"author_id"         => $podcast->author_id,
            //"writer_id"         => $podcast->writer_id,
            "lang"              => $podcast->locale,
            "code"              => (string)$podcast->code,
            "name"              => $podcast->title,
            //"subtitle"          => "",
            "description"       => (string)$podcast->description,
            "image_url"         => ma_get_image_from_repository_if_exists($podcast->image),
            "cover_image_url"   => ma_get_thumbnail_image($podcast->image),
            "podcast"           => str_replace('audio/','',$podcast->podcast),
            "podcast_url"       => ma_get_audio_from_repository_if_exists($podcast->podcast),
            "podcast_size"      => (string)$podcast->podcast_size,
            "podcast_length"    => $podcast->podcast_length,
            "podcast_last_modified"    => $podcast->podcast_last_modified,
            "sort"              => $podcast->sort,
            "is_active"         => $podcast->is_active,
            "is_social"         => $podcast->is_social,
            "is_free"           => $podcast->is_free,
            //"updated_at"        => $podcast->updated_at,
            //'podcasts'          => $podcast->podcasts,
        ];
    }
}