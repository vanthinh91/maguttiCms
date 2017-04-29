<?php namespace App\MaguttiCms\Api\V1\Controllers;

use Validator;
use Illuminate\Http\Request;

class ServicesController extends ApiController
{
    protected  $request;
    public function __construct( )
    {
    }

    public function modellist( $model,Request $request)
    {
        $this->setMsg($model);
        $curModel = getModelFromString($model);
        $curObj   = new  $curModel ;
        $data     = $curObj->all();
        if($data){
            $this->setData($data);
            $this->responseSuccess();
        }
        else $this->setEnableLog(false)->responseWithError();
        return $this->apiResponse();
    }
    public function show( $model,$id,Request $request)
    {
        $this->setMsg($model);
        $curModel = getModelFromString($model);
        $curObj   = new  $curModel;
        $data  = $curObj->find($id);

        if($data){
            $this->setData($data);
            $this->responseSuccess();
        }
        else $this->setEnableLog(false)->responseWithError();
        return $this->apiResponse();
    }
}