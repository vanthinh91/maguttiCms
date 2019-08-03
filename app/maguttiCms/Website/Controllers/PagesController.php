<?php

namespace App\maguttiCms\Website\Controllers;


use App\Http\Controllers\Controller;
use Input;
use Validator;

use hisorange\BrowserDetect\Facade as Browser;

use Domain;
use App\Product;
use App\FaqCategory;
use  \App\maguttiCms\SeoTools\LaraCmsSeoTrait;
use App\maguttiCms\Website\Repos\Article\ArticleRepositoryInterface;
use App\maguttiCms\Website\Repos\News\NewsRepositoryInterface;

class PagesController extends Controller
{

    use LaraCmsSeoTrait;
	/**
	* @var
	*/
	protected $template;
	/**
	* @var ArticleRepositoryInterface
	*/
	protected $articleRepo;
	/**
	* @var NewsRepositoryInterface
	*/
	protected $newsRepo;
	/**
	* @var NewsRepositoryInterface
	*
	*
	*/
	private $news;

	/**
	* @param ArticleRepositoryInterface $article
	* @param PostRepositoryInterface $news
	*/

	public function __construct(ArticleRepositoryInterface $article, NewsRepositoryInterface $news)
	{
		$this->articleRepo = $article;
		$this->newsRepo    = $news;
	}


	public function home()
	{
		$article = $this->articleRepo->getBySlug('home');
		$this->setSeo($article);
		return view('website.home', compact('article'));
	}

	public function pages($parent, $child='')
	{
		$article = (!$child) ? $this->articleRepo->getParentPage($parent, app()->getLocale()) : $this->articleRepo->getSubPage($parent, $child);

		// Get website default locale
		$fallback_locale = \Config::get('app.fallback_locale');

		if ($article && $article->slug != 'home' && $article->pub==1) {
			$this->setSeo($article);
			$this->template = ($article->template_id) ?  $article->template->value : $article->{'slug:'. $fallback_locale};
			if (view()->exists('website.'. $this->template)) {
				return view('website.'.$this->template, compact('article'));
			}
			return view('website.normal', compact('article'));
		} else {
			return redirect(url_locale('/'));
		}
	}


	public function contacts()
	{
		$article = $this->articleRepo->getBySlug('contatti');
		$this->setSeo($article);
		$parameter = Input::get('product_id');

		if ($parameter && !is_array($parameter)) {
			$product = Product::findOrFail($parameter);
			return view('website.contacts', ['request_product_id' => $parameter, 'product' => $product, 'article' => $article]);
		} else {
			return view('website.contacts', ['request_product_id' => 0, 'article' => $article]);
		}
	}

	
	public function news($slug = '')
	{
		$article = $this->articleRepo->getBySlug('news');

		if ($slug=='') {
			$news = $this->newsRepo->getPublished();
			$this->setSeo($article);
			$this->setPagination($news);
			return view('website.news.index', compact('article', 'news'));
		} else {
			$news = $this->newsRepo->getBySlug($slug, app()->getLocale());
			if ($news) {
				$this->setSeo($news);
				$locale_article = $news;
				return view('website.news.single', compact('article', 'news', 'locale_article'));
			}
			return redirect(url_locale('/'));
		}
	}
}
