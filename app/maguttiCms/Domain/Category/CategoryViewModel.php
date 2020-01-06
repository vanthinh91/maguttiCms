<?php

namespace App\maguttiCms\Domain\Category;

use App\Category;
use App\maguttiCms\Domain\Website\WebsiteViewModel;

class   CategoryViewModel extends WebsiteViewModel
{



    function show($slug)
    {
        $category = Category::findBySlug($slug, app()->getLocale());;
        if ($category) {

            $article = $this->getCurrentPage();
            $this->setSeo($category);
            $locale_article = $category;
            $products = $category->products()->published()->orderBy('sort')->get();
            return view('website.category', compact('article', 'category', 'products', 'locale_article'));
        } else {
            return $this->handleMissingPage();
        }
    }

    function index()
    {
        $article = $this->getCurrentPage();
        $categories = Category::published()->orderBy('title')->get();
        $this->setSeo($article);
        return view('website.categories', ['article' => $article, 'categories' => $categories]);

    }

    function handle($slug)
    {
       return ($slug == '') ? $this->index() : $this->show($slug);
    }
}