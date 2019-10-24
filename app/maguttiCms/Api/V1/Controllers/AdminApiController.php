<?php namespace App\maguttiCms\Api\V1\Controllers;

use App\Article;
use App\Block;
use App\maguttiCms\Admin\AdminFormFieldsProcessor as AdminFormFieldsProcessor;
use App\maguttiCms\Admin\DashBoardComponent;
use App\maguttiCms\Admin\NavBarComponent;
use App\maguttiCms\Tools\CodeGeneratorHelper;
use Url;
use Validator;
use Illuminate\Http\Request;

use App\maguttiCms\Tools\JsonResponseTrait;

class AdminApiController
{
    use JsonResponseTrait;

    protected $request;


    public function create(Request $request)
    {
        $this->request = $request;
        $item = new Block;
        (new AdminFormFieldsProcessor($request))->requestFieldHandler($item);
        Article::find($this->request->model_id);
        $this->setData($item)->responseSuccess();

        return $this->apiResponse();
    }

    public function update(Request $request)
    {
        $this->request = $request;
        $data = (new NavBarComponent($this->request))->getData();
        ($data) ? $this->setData($data)->responseSuccess(): $this->setEnableLog(false)->responseWithError();
        return $this->apiResponse();
    }


}