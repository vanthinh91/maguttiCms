<?php

namespace App\maguttiCms\Domain\Article;


use App\Product;
use App\maguttiCms\Domain\Website\WebsiteViewModel;

class ArticleViewModel extends WebsiteViewModel
{


    function index()
    {
        $article = $this->getPage('home');
        $this->setSeo($article);
        return view('website.home', compact('article'));
    }

    function show($parent, $child = '')
    {


        $article = (!$child) ? $this->getParentPage($parent, app()->getLocale()) : $this->getSubPage($parent, $child);
        if ($this->validatePage($article)) {
            $this->setSeo($article);
            $template = $this->handleTemplate($article);
            return view($template, compact('article'));
        } else {
            return redirect(url_locale('/'));
        }
    }


    function contacts()
    {
        $article = $this->getPage('contatti');
        $this->setSeo($article);
        $parameter = request()->get('product_id');
        if ($parameter && !is_array($parameter)) {
            $product = Product::findOrFail($parameter);
            return view('website.contacts', ['request_product_id' => $parameter, 'product' => $product, 'article' => $article]);
        } else {
            return view('website.contacts', ['request_product_id' => 0, 'article' => $article]);
        }
    }


    function getParentPage($parent)
    {

        $page = $this->getPage($parent, app()->getLocale());
        // Return false if page has parent because this method is used only for parent page
        return ($page && $page->parent_id != 0) ? false : $page;

    }

    public function getSubPage($parent, $child)
    {
        $parent = $this->getPage($parent);
        $child = $this->getPage($child);

        // If $parent or $child doesn't exists
        if (!$parent || !$child) {
            return false;
        }

        // If $parent and $child doesn't match
        if ($parent->id != $child->parent_id) {
            return false;
        }

        // Return $child data
        return $child;
    }

    function handleTemplate($article)
    {

        // Get website default locale
        $fallback_locale = \Config::get('app.fallback_locale');
        $template = ($article->template_id) ? $article->template->value : $article->{'slug:' . $fallback_locale};
        return (view()->exists('website.' . $template)) ? 'website.' . $template : 'website.normal';

    }

    function validatePage($article)
    {

        return ($article && $article->slug != 'home' && $article->pub == 1) ? true : false;

    }

    function handle($parent, $child = '')
    {

        if ($parent == 'home') return $this->index();
        if ($parent == 'contacts') return $this->contacts();
        return $this->show($parent, $child);;
    }
}