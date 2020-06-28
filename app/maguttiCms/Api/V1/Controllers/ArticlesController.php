<?php


namespace App\maguttiCms\Api\V1\Controllers;


use App\Article;
use App\maguttiCms\Tools\JsonApiResponseTrait;

class ArticlesController extends BaseApiController
{
    use JsonApiResponseTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    function index(){
        return Article::paginate(10);
    }
}