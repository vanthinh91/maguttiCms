<?php

namespace App\maguttiCms\Domain\Category;

use App\Category;
use App\News;
use \App\maguttiCms\SeoTools\MaguttiCmsSeoTrait;

class CategoryViewModel
{

    use MaguttiCmsSeoTrait;

    function __construct()
    {

    }


    function show($slug, $article)
    {
        $category = Category::findBySlug($slug, app()->getLocale());;
        if ($category) {
            $this->setSeo($category);
            $locale_article = $category;
            $products = $category->products()->published()->orderBy('sort')->get();
            return view('website.category', compact('article', 'category', 'products', 'locale_article'));
        } else {
            return redirect('/');
        }
    }

    function index($article)
    {
        // lista categorie
        $categories = Category::published()->orderBy('title')->get();
        $this->setSeo($article);
        return view('website.categories', ['article' => $article, 'categories' => $categories]);

    }

    function handle($article, $slug)
    {
        return ($slug == '') ? $this->index($article) : $this->show($slug, $article);;
    }
}