<?php

namespace App\maguttiCms\Website\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use App\maguttiCms\Domain\Category\CategoryViewModel;
use App\maguttiCms\Domain\Product\ProductViewModel;



/**
 * Class ProductsController
 * @package App\maguttiCms\Website\Controllers
 */
class ProductsController extends Controller
{


    public function __construct()
    {

    }


    public function category($category_slug = '')
    {

        $article = Article::findBySlug('products');

        return (new CategoryViewModel())->handle($article, $category_slug);

    }


    public function products($category_slug, $product_slug)
    {
        $article = Article::findBySlug('products');
        return (new ProductViewModel())->handle($article, $product_slug);
    }
}
