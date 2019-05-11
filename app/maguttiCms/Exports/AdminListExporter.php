<?php
/**
 * Created by PhpStorm.
 * User: web01
 * Date: 07/08/18
 * Time: 16:22
 */

namespace App\maguttiCms\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\maguttiCms\Searchable\SearchableTrait;
use App\maguttiCms\Tools\ExportHelper;

/**
 * Class AdminListExporter
 * @package App\maguttiCms\Exports
 */
class AdminListExporter extends  ExportHelper implements FromCollection, WithHeadings
{
    use Exportable;
    use SearchableTrait;

    function __construct($model)
    {
        $this->config = config('maguttiCms.admin.list.section.' . $model);
        $this->modelClass = 'App\\' . $this->config['model'];
        $this->setFilename($this->config['model'] . '_' . date('Y-m-d') . '.xlsx');
        $this->request = request();
    }

    public function collection()
    {
        return collect( $this->getDataToExport() );
    }

    public function headings(): array
    {
        return $this->getHeadersFromConfig();
    }

    /**
     * @return array
     */
    public function getDataToExport()
    {
        $items = $this->getData();
        foreach ( $items as $item) {
            $this->itemsArray[] = $this->mapData($item);
        }
        return $this->itemsArray;
    }


    public function addHeader()
    {
        $this->itemsArray[] = $this->headings();
        return $this;
    }

    /**
     * @param $item
     * @return mixed
     */
    protected function mapData($item)
    {
        $dataArray = array();
        foreach ($this->config['field_exportable'] as $field) {
            $a = $field['field'];
            if ($field['type'] == 'text') {
                array_push($dataArray, $item->$a);
            }
            if ($field['type'] == 'relation') {
                if (isset($item->{$field['relation']}->{$field['field']})) {
                    array_push($dataArray, $item->{$field['relation']}->{$field['field']});
                } else {
                    array_push($dataArray, '');
                }
            }
            if ($field['type'] == 'integer') {
                array_push($dataArray, $item->$a);
            }
            if ($field['type'] == 'datetime') {
                array_push($dataArray, $item->$a->format('m-d-Y h:m'));
            }
        }
        return $dataArray;
    }

    protected function getData()
    {
        $this->model = new  $this->modelClass;
        $objBuilder = $this->model::query();
        $this->searchFilter($objBuilder);
        $this->whereFilter($objBuilder);
        $this->orderFilter($objBuilder);
        $this->withHelperFilter($objBuilder);
        $this->joinable($objBuilder);
        $this->withRelation($objBuilder);
        return $objBuilder->get();
    }


    public function withHelperFilter($objBuilder)
    {
        return (data_get($this->config, 'with_exportable')) ? $objBuilder->with($this->config['with_exportable']) : '';
    }
}