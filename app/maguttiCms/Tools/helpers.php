<?php

use App\Article;
use App\maguttiCms\Tools\Tool;
use App\maguttiCms\Tools\HtmlHelper;
use App\maguttiCms\Tools\StoreHelper;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// localization
function get_locale()
{
    return LaravelLocalization::getCurrentLocale();
}

function url_locale($url)
{
    return LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), URL::to($url));
}

// This function return the route slug url
function route_url_locale($slug)
{
    return url_locale(trans('routes.'. $slug));
}

function page_permalink_by_id($page_id, $locale='')
{
    return Article::getPermalinkById($page_id, $locale);
}

function get_image($file)
{
    return ma_get_image_from_repository($file);
}

function get_doc($file)
{
    return ma_get_doc_from_repository($file);
}

// icons
function icon($icons, $classes = '', $force_set = '', $echo = true)
{
    return Htmlhelper::createFAIcon($icons, $classes, $force_set, $echo);
}

// store
function store_currency()
{
    return config('maguttiCms.store.currency_symbol');
}

function store_enabled()
{
    return StoreHelper::isStoreEnabled();
}

// development
function loremImage($width = 800, $height = 800)
{
    return 'https://picsum.photos/'.$width.'/'.$height.'?image='.rand(0, 1000);
}

function human_filesize($path, $decimals = 1)
{
    $bytes = filesize($path);
    $sz = 'BKMGTP';
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor].'B';
}

function generate_password()
{
    return Tool::generatePassword();
}
