<?php

namespace App\maguttiCms\Website\Controllers;

use App\maguttiCms\Website\Repos\Article\ArticleRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Input;
use Validator;
use App\Article;
use App\City;
use App\Province;
use App\maguttiCms\Tools\SeoLandingHelper;

class SeoLandingController extends Controller
{
    use \App\maguttiCms\SeoTools\maguttiCmsSeoTrait;
    /**
     * @var
     */
    protected $template;
    /**
     * @var ArticleRepositoryInterface
     */
    protected $articleRepo;

    /**
     * @param ArticleRepositoryInterface $article
     */

    public function __construct(ArticleRepositoryInterface $article)
    {
        $this->articleRepo = $article;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productByCity($product, $city)
    {
		$setting = 'product-by-city';
        $article = $this->articleRepo->getBySlug($setting);

		if (!$article) {
			return redirect()->to(url_locale('/'));
		}

		$province = Province::where('slug', $city)->first();
		$product = config('maguttiCms.website.seolanding.'.$setting.'.product.'.$product);
		$city = config('maguttiCms.website.seolanding.'.$setting.'.city.'.$city);

		if (!$city || !$product || !$province) {
			return redirect()->to(url_locale('/'));
		}

		$article->title = SeoLandingHelper::replaceTags($article->title, compact('product', 'city'));
		$article->subtitle = SeoLandingHelper::replaceTags($article->subtitle, compact('product', 'city'));
		$article->description = SeoLandingHelper::replaceTags($article->description, compact('product', 'city'));
		$article->seoTitle = SeoLandingHelper::replaceTags($article->seoTitle, compact('product', 'city'));
		$article->seoDescription = SeoLandingHelper::replaceTags($article->seoDescription, compact('product', 'city'));

		$this->setSeo($article);

		return view('website.seo.product-by-city', compact('article', 'product', 'city', 'province'));
    }
}
