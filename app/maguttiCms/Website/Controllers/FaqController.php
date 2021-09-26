<?php

namespace App\maguttiCms\Website\Controllers;


use App\maguttiCms\Domain\Faq\FaqViewModel;


/**
 *
 */
class FaqController extends PagesController
{
    function index( string $slug = '')
    {
        return (new FaqViewModel('faq'))->handle($slug);
    }
}
