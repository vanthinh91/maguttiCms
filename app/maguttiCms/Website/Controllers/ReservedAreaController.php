<?php

namespace App\maguttiCms\Website\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Input;
use Validator;

use App\Article;
use App\maguttiCms\Website\Repos\Article\ArticleRepositoryInterface;
use App\maguttiCms\Website\Repos\News\NewsRepositoryInterface;


class ReservedAreaController extends Controller

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
     * @param ArticleRepositoryInterface $article
     *
     */

    public function __construct(ArticleRepositoryInterface $article )
    {
        $this->articleRepo = $article;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        $article =$this->articleRepo->getBySlug('user-dashboard');
        $this->setSeo($article);
        return view('website.users.dashboard',compact('article'));
    }
    public function profile()
    {

        $article =$this->articleRepo->getBySlug('user-profile');
        $this->setSeo($article);
        return view('website.users.profile',compact('article'));
    }
}