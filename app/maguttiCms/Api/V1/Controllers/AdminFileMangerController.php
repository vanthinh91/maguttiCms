<?php namespace App\maguttiCms\Api\V1\Controllers;

use Url;
use Validator;
use Illuminate\Http\Request;

use App\maguttiCms\Tools\JsonResponseTrait;

use App\maguttiCms\Domain\Media\Resource\AdminMediaResource;
use App\Media;


class AdminFileMangerController
{
    use JsonResponseTrait;


    /**
     * @var Request
     */
    private Request $request;

    public function index(Request $request,$id=null)
    {
        $this->request = $request;
        $object = Media::when($id, function ($query) use ($id) {
            $query-> orderByRaw('IF(FIELD(id,'.$id.')=0,1,0)');
        })->orderBy('id', 'DESC')->get();
        $items = AdminMediaResource::collection($object);
        return $this->setData($items)->responseSuccess()->apiResponse();
    }


}