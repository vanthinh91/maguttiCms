<?php namespace App\MaguttiCms\Api\V1\Transformers;

use App\News;
use League\Fractal;


class NewsTransformer extends Fractal\TransformerAbstract
{
    public function transform(News $news)
    {
        return [
            'id'          => (int) $news->id,
            'date'        => $news->date,
            'title'       => $news->title,
            'description' => $news->description,
            'ext_link'    => $news->link,
            'is_active'   => $news->pub,
            "image_url"   => ma_get_image_from_repository_if_exists($news->image),
            'lang'        => app()->getLocale(),
         ];
    }
}