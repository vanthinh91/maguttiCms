<?php namespace App\maguttiCms\Tools;


/**
 * Class ExportHelper
 * @package App\maguttiCms\Tools
 */
class ExportHelper
{

    /**
     * @var
     */
    protected $model;

    /**
     * @var
     */
    protected $modelClass;
    /**
     * @var
     */
    protected $config;


    /**
     * @var
     */
    protected $fileName;

    /**
     * @var
     */
    protected $request;

    /**
     * @param $model
     * @return $this
     */

    protected  $itemsArray=[];


    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFilename($name)
    {
        $this->fileName = $name;
        return $this;
    }

    public function getHeadersFromConfig()
    {
        return collect($this->config['field_exportable'])->pluck('label')->toArray();
    }
    static function exportFilename($filename)
    {
        return $filename . '_' . date('Y-m-d') . '.xlsx';
    }
}