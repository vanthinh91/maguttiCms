<?php namespace App\MaguttiCms\Api\V1\Controllers;

use Illuminate\Http\Request;
use DB;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

/**
 * Class UserController
 * @package App\MaguttiCms\Api\V1\Controllers
 */
class SearchController extends ApiController
{


    private $fractal;

    public function lista( $model,Request $request)
    {

        $this->request  = $request;
        $modelObj       = getModelFromString($model);
        $curObj         = (new  $modelObj)->newQuery();

        $filterModel   = 'App\MaguttiCms\Filter\\'.ucfirst($model).'Filters';
        $filters       = ( new $filterModel($this->request) );
        $curObj->filter($filters);


        $itemsPaginator = $curObj->paginate($this->getLimit());
        $data = $itemsPaginator->items(); // Transform data

        if(count($data)>0){
            $this->setData($data);
            $this->setMsg($model)->responseSuccess();
        }
        else $this->responseNotFound();
        return $this->apiResponse();
    }


    /*
     *   $this->request  = $request;
        $modelObj       = getModelFromString($model);
        $itemsPaginator = ( new  $modelObj)->newQuery();;
        $filterModel = 'App\MaguttiCms\Filter\ProdcastFilters';
        $filters = (new $filterModel($this->request));
        $itemsPaginator->filter($filters);
        $itemsPaginator->paginate($this->getLimit());
     */
}