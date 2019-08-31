<?php

namespace App\maguttiCms\Domain\Product;

use App\Product;
use \App\maguttiCms\SeoTools\MaguttiCmsSeoTrait;

class ProductViewModel
{

    use MaguttiCmsSeoTrait;

    function __construct()
    {

    }


    function show($slug, $article)
    {
        $product = Product::findBySlug($slug, app()->getLocale());;
        // singolo prodotto
        if ($product) {
            $category = $product->category;
            $locale_article = $product;
            $this->setSeo($product);
            return view('website.product', compact('article', 'product', 'category', 'locale_article'));
        } else {
            return redirect('/');
        }
    }

    

    function handle($article, $slug)
    {
        return ($slug == '') ? $this->index($article) : $this->show($slug, $article);;
    }
}