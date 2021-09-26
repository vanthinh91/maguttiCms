<?php

namespace App\maguttiCms\Website\Controllers;


use Input;
use Validator;
use App\Http\Controllers\Controller;

use App\maguttiCms\Domain\Faq\FaqViewModel;
use App\maguttiCms\Domain\News\NewsViewModel;
use App\maguttiCms\Domain\Article\ArticleViewModel;


class NewsController extends Controller
{

    public function news(string $slug = '')
    {
        return (new NewsViewModel('news'))->handle($slug);
    }

    public function newsByTags(string $tag)
    {
        return (new NewsViewModel('news'))->index($tag);
    }
}
