<?php

namespace App\maguttiCms\Domain\Product;

use App\Product;
use App\maguttiCms\Domain\Website\WebsiteViewModel;


class ProductViewModel extends WebsiteViewModel
{


    function show(string $slug)
    {
        $product = Product::findBySlug($slug, app()->getLocale());
        $article = $this->getCurrentPage();
        // single product
        if ($product) {
            $category = $product->category;
            $locale_article = $product;
            $this->setSeo($product);
            return view('website.product', compact('article', 'product', 'category', 'locale_article'));
        }
        return $this->handleMissingPage();
    }
}