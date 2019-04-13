<?php namespace App\MaguttiCms\Api\V1\Transformers;

use App\Category;
use League\Fractal;


class CategoryTransformer extends Fractal\TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'id'          => (int) $category->id,
            'title'       => $category->title,
            'is_active'   => $category->is_active,
            "image_url"   => ma_get_image_from_repository_if_exists($category->image),
            'lang'        => app()->getLocale(),
        ];
    }
}