<?php

namespace App\maguttiCms\Domain\News;


use App\News;
use App\maguttiCms\Domain\Website\WebsiteViewModel;


class NewsViewModel extends WebsiteViewModel
{

    function show($slug)
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

    function index()
    {
        $article = $this->getCurrentPage();
        $news = News::findPublished()->paginate(config('maguttiCms.website.option.pagination.news_index'));
        $this->setSeo($article);
        $this->setPagination($news);
        return view('website.news.index', compact('article'));
    }

    function handle($slug)
    {
        return ($slug == '') ? $this->index() : $this->show($slug);;
    }
}