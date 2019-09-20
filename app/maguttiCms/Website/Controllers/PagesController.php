<?php

namespace App\maguttiCms\Website\Controllers;

use Input;
use Validator;
use App\Http\Controllers\Controller;

use App\maguttiCms\Domain\Article\ArticleViewModel;
use App\maguttiCms\Domain\News\NewsViewModel;


class PagesController extends Controller
{

    public function home()
    {
        return (new ArticleViewModel())->handle('home');
    }

    function pages($parent, $child = '')
    {
        return (new ArticleViewModel())->handle($parent, $child);
    }

    public function contacts()
    {
        return (new ArticleViewModel())->handle('contacts');
    }

    public function news($slug = '')
    {
        return (new NewsViewModel('news'))->handle($slug);
    }
}
