<?php namespace App\MaguttiCms\Api\V1\Transformers;
use App\Author;
use League\Fractal;

class AuthorTransformer extends Fractal\TransformerAbstract
{
    public function transform(Author $author)
    {
        return [
            'id'                => (int) $author->id,
            "title"             => $author->title,
            //"description"       => $author->description,
            //"image_url"         => ma_get_image_from_repository_if_exists($author->image),
            //"cover_image_url"   => ma_get_thumbnail_image($author->image),
            "is_active"         => $author->is_active,
        ];
    }
}