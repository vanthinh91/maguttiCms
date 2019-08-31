<?php

namespace App\maguttiCms\Domain\News;


use App\News;
use \App\maguttiCms\SeoTools\MaguttiCmsSeoTrait;

class NewsViewModel
{

    use MaguttiCmsSeoTrait;
    function __construct()
    {

    }




    function show($slug,$article)
    {
        $news = News::findBySlug($slug, app()->getLocale());
        if ($news) {
            $this->setSeo($news);
            $locale_article = $news;
            return view('website.news.single', compact('article', 'news', 'locale_article'));
        }
        return redirect(url_locale('/'));
    }

    function index($article)
    {
        $news = News::findPublished()->paginate(config('maguttiCms.website.option.pagination.news_index'));
        $this->setSeo($article);
        $this->setPagination($news);
        return view('website.news.index', compact('article', 'news'));
    }

    function handle($article, $slug)
    {
        return ($slug == '') ? $this->index($article) : $this->show($slug,$article);;
    }
}