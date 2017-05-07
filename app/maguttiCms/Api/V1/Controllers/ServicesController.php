<?php namespace App\MaguttiCms\Api\V1\Controllers;

use Validator;
use Illuminate\Http\Request;

class ServicesController extends ApiController
{
    protected  $request;
    protected  $model;
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

    public function update( $model,$id,Request $request)
    {
        $this->request = $request;
        $this->setMsg($model);
        $curModel = getModelFromString($model);
        $this->model =  $curModel::whereId($id)->firstOrFail();
        $this->requestFieldHandler();
        if($this->model){
            $this->setData($this->model);
            $this->responseSuccess();
        }
        else $this->setEnableLog(false)->responseWithError();
        return $this->apiResponse();
    }

    public function create( $model,Request $request)
    {

        $this->request = $request;

        $this->setMsg($model);
        $curModel = getModelFromString($model);
        $this->model   = new  $curModel;
        $this->requestFieldHandler();

        if($this->model){
            $this->setData($this->model);
            $this->responseSuccess();
        }
        else $this->setEnableLog(false)->responseWithError();

        return $this->apiResponse();
    }


    public function requestFieldHandler()
    {
        foreach ($this->model->getFillable() as $a) {
            $this->model->$a = $this->request->get($a);
        }
        if (isset($this->model->sluggable)) {
            foreach ($this->model->sluggable as $a) {
                $this->model->$a = $this->sluggy($this->model, $this->request->get($a));
            }
        }

        $this->model->save();

        if (isset($this->model->translatedAttributes) && count($this->model->translatedAttributes) > 0) {
            foreach (config('app.locales') as $locale => $value) {
                foreach ($this->model->translatedAttributes as $attribute) {
                    if (config('app.locale') != $locale) $this->model->translateOrNew($locale)->$attribute = $this->request->get($attribute . '_' . $locale);
                    else $this->model->translateOrNew($locale)->$attribute = $this->request->get($attribute);
                }
                $this->model->save();
            }
        }

        return $this->model;
    }

    public function delete( $model,$id,Request $request)
    {
        $this->request = $request;
        $this->setMsg($model);
        $curModel = getModelFromString($model);


        if($curModel::find($id)->delete()){
           $this->responseSuccess();
        }
        else $this->setEnableLog(false)->responseWithError();

        return $this->apiResponse();
    }

}