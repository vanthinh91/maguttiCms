<?php

namespace App\maguttiCms\Domain\Faq;


use App\Faq;
use App\maguttiCms\Domain\Website\WebsiteViewModel;

/**
 * Class FaqViewModel
 * @package App\maguttiCms\Domain\Faq
 */
class FaqViewModel extends WebsiteViewModel
{

    function index()
    {
        $article = $this->getCurrentPage();
        $faqs = Faq::sorted()->get();// get active and sorted by sort ASC order
        $this->setSeo($article);
        return view('website.faq.index', compact('article', 'faqs'));
    }

    function handle($slug)
    {
        return ($slug == '') ? $this->index() : $this->show($slug);;
    }
}