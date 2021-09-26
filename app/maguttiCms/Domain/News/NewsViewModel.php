<?php

namespace App\maguttiCms\Domain\News;


use App\News;
use App\maguttiCms\Domain\Website\WebsiteViewModel;


class NewsViewModel extends WebsiteViewModel
{

    function index( string $tag='')
    {
        $article = $this->getCurrentPage();
        $news = News::itemList($tag);
        $this->setSeo($article);
        if($tag)\SEO::setTitle( $this->title.' - '.$tag );
        $this->setPagination($news);
        return view('website.news.index', compact('article','tag'));
    }

    function show(string $slug)
    {
        $news = News::findBySlug($slug, app()->getLocale());
        $article = $this->getCurrentPage();
        if ($news) {
            $this->setSeo($news);
            $locale_article = $news;
            return view('website.news.single', compact('article', 'news', 'locale_article'));
        }
        return redirect(url_locale('/'));
    }

}