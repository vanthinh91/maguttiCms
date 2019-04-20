<?php namespace App\MaguttiCms\Api\V1\Controllers;

use Url;
use Validator;
use Illuminate\Http\Request;

class AdminServicesController extends ApiController
{
    protected $request;
    protected $model;
    protected $config;

    public function __construct()
    {
        $this->config = config('maguttiCms.admin.list');
    }

    public function dashboard(Request $request)
    {
        $this->request = $request;
        $data = collect();
        $data->push([
            'title' => 'Web site',
            'url' => url()->to(''),
            'iconClass' => 'fas fa-globe',
            'target' => "_new",
        ]);

        foreach ($this->getDashBoardItems() as $_code => $section) {
            $data->push([
                'title' => trans('admin.models.' . $_code),
                'url' => ma_get_admin_list_url($section['model']),
                'iconClass' => 'fas fa-' . $section['icon'],
                'target' => null,
            ]);
        }
        if ($data) {
            $this->setData($data);
            $this->responseSuccess();
        } else $this->setEnableLog(false)->responseWithError();

        return $this->apiResponse();
    }

    public function navbar(Request $request)
    {
        $this->request = $request;
        $data = collect();
        $data->push([
            'title' => 'Web site',
            'url' => url()->to(''),
            'iconClass' => 'fas fa-globe',
            'target' => "_new",
            'section' => '',
            'submenu' =>[]
        ]);

        foreach ($this->getNavBarItems() as $_code => $section) {
            $data->push([
                'title' => trans('admin.models.' . $_code),
                'url' => ma_get_admin_list_url($section['model']),
                'iconClass' => 'fas fa-' . $section['icon'],
                'target' => null,
                'section' => $_code,
                'submenu' => $this->getNavBarSubItems($section,$_code)
               ]
            );
        }
        if ($data) {
            $this->setData($data);
            $this->responseSuccess();
        } else $this->setEnableLog(false)->responseWithError();

        return $this->apiResponse();
    }

    function getDashBoardItems(){

        return collect($this->config['section'])->where('menu.home')->filter(
            function ($section) {
                return auth_user('admin')->canViewSection($section);
            }
        );
    }

    function getNavBarItems(){
        return collect($this->config['section'])->where('menu.top-bar.show')->filter(
            function ($section) {
                return auth_user('admin')->canViewSection($section);
            }
        );
    }

    function getNavBarSubItems($section,$parent){
        $data = collect();

        if(isset($section['menu']['top-bar']['submodel'])){
            foreach ($section['menu']['top-bar']['submodel'] as $_code => $item ){
                $data->push([
                    'title' => trans('admin.models.' . $_code),
                    'url' => ma_get_admin_list_url($_code),
                    'iconClass' => 'fas fa-' . $item['icon'],
                    'target' => null,
                    'section' => $_code,

                ]);
            }
        }


        return $data;

    }
}