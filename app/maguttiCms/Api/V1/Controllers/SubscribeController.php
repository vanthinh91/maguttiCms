<?php namespace App\MaguttiCms\Api\V1\Controllers;

use App\Subscriber;
use Validator;
use Illuminate\Http\Request;

class SubscribeController extends ApiController
{
    protected  $request;
    protected  $model;
    public function __construct( )
    {
    }

    public function subscribeNotification( Request $request)
    {
        $this->request = $request;
        $validator = $this->validator('notifications',$this->request);

        if ($validator->fails()) {
            $this->responseNotFound("Wrong Data");
        }
        else {
            $token = $this->request->get('token');
            $data= Subscriber::registerUser($token,'firebase');
            if($data){
                $this->setData($data);
                $this->responseSuccess();
            }
            else $this->setEnableLog(false)->responseWithError();
        }

        return $this->apiResponse();
    }



}