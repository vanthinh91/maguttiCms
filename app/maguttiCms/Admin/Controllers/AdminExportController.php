<?php

namespace App\maguttiCms\Admin\Controllers;

use App\maguttiCms\Exports\AdminListExporter;
use App\maguttiCms\Exports\CollectionExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Input;

use App\maguttiCms\Tools\ExportHelper;

/**
 * Class AdminExportController
 * @package App\maguttiCms\Admin\Controllers
 */
class AdminExportController extends Controller
{
    protected $model;
    protected $models;
    protected $modelClass;
    protected $curObject;
    protected $request;
    protected $config;
    protected $id;

    /**
     * @param $model
     * @param string $sub
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function lista($model, $sub = '')
    {
        if(request()->filled('debug'))return  ExportHelper::exportFilename($model) ;
        return Excel::download(new AdminListExporter($model), ExportHelper::exportFilename($model));
    }
    public function list_from_collection($model, $sub = '')
    {
        $ExportHelper = new AdminListExporter($model);
        $data         = $ExportHelper->addHeader()->getDataToExport();
        if(request()->filled('debug'))return  $ExportHelper->getFileName() ;
        return Excel::download(new CollectionExport($data), $ExportHelper->getFileName() );
    }
}