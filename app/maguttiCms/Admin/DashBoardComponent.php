<?php namespace App\maguttiCms\Admin;
use App\maguttiCms\Website\Facades\StoreHelper;
use Form;
use App;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminTree
 * @package App\maguttiCms\Admin
 */
class DashBoardComponent  {

    protected $data;
    protected $request;
    protected $config;

    public function __construct($request)
    {
        $this->request = $request;
        $this->config = config('maguttiCms.admin.list');
        $this->data = collect();
        $this->init();
    }

    public function init()
    {
        $this->data->push([
            'title' => 'Website',
            'url' => url()->to(''),
            'iconClass' => 'fas fa-globe',
            'target' => "_new",
            'footer_url' => url()->to(''),
            'footer_icon' => 'fas fa-external-link-alt',
            'section' =>'See website'
        ]);
    }


    function getData(){
        foreach ($this->getDashBoardItems() as $_code => $section) {
            $modelClass = 'App\\' . $section['model'];
            $model = new $modelClass;
            $this->data->push([
                'title' => trans('admin.models.' . $_code),
                'model' => $section['model'],
                'url' => ma_get_admin_list_url($section['model']),
                'iconClass' => 'fas fa-' . $section['icon'],
                'pills' => $model::count(),
                'footer_url' => (data_get($section['actions'],'create'))? ma_get_admin_create_url($section['model']):'',
                'target' => null,
                'total' => $this->getTotalAmount($section,$model),
                'section' =>data_get($section,'section','cms')
            ]);
        }
        return $this->data;
    }

    function getDashBoardItems(){
        return collect($this->config['section'])->where('menu.home')->filter(
            function ($section) {
                return auth_user('admin')->canViewSection($section);
            }
        );
    }

    function getTotalAmount($section,$model){
      return (data_get($section,'total'))?StoreHelper::formatPrice($model::sum(data_get($section,'total'))):null;
    }
}
