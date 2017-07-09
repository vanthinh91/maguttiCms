<?php

namespace App\maguttiCms\Website\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\maguttiCms\Website\Repos\Article\ArticleRepositoryInterface;
use App\maguttiCms\Website\Repos\Product\ProductRepositoryInterface;
use Input;
use Validator;
use App\Product;
use App\Domain;

/**
 * Class ProductsController
 * @package App\maguttiCms\Website\Controllers
 */
class ProductsController extends Controller
{
	use \App\maguttiCms\SeoTools\laraCmsSeoTrait;
    /**
     * @var
     */
    protected  $template;
    /**
     * @var ArticleRepositoryInterface
     */
    protected  $articleRepo;


    /**
     * @var ProductRepositoryInterface
     */
    protected  $productRepo;

    /**
     * ProductsController constructor.
     * @param ArticleRepositoryInterface $article
     * @param ProductRepositoryInterface $product
     */
    public function __construct(ArticleRepositoryInterface $article, ProductRepositoryInterface $product )
    {
        $this->articleRepo = $article;
        $this->productRepo = $product;
    }

    /**
     * @param string $product_slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function products($product_slug='' ) {

        $article = $this->articleRepo->getBySlug('products');
        if( $product_slug == '' ) {
            $product  = $this->productRepo->getPublished();
            $this->setSeo($article);
            return view('website.products', ['article' => $article, 'products' => $product]); //LISTA PRODOTTI

        }else{
            $product = Product::where('slug', $product_slug)
                ->where('pub', 1)
                ->first();
			if ($product) {
				$this->setSeo($product);
				return view('website.product_single', ['article' => $article, 'product' => $product]); //SINGOLO PRODOTTO
			}
			else
				return redirect('/');
        }
    }
}
