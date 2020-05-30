<?php

namespace App\maguttiCms\Admin;


use App\maguttiCms\Admin\Decorators\AdminListComponentableTrait;
use Carbon\Carbon;
Use Form;
Use App;
use Illuminate\Support\Str;


use App\maguttiCms\Admin\Decorators\AdminListSeparator;
use App\maguttiCms\Admin\Decorators\AdminListSortableHeader;

/**
 * Class AdminList
 * @package App\maguttiCms\Admin
 */
class AdminList
{


    use AdminListSeparator,AdminListSortableHeader,AdminListComponentableTrait;


    /**
     * @var
     */
    protected $html;
    /**
     * @var
     */
    protected $property;
    protected $action_list = ['edit', 'delete', 'view', 'copy', 'impersonate'];


    /**
     * @param $property
     * @return $this
     */
    public function initList($property)
    {
        $this->html = "";
        $this->property = $property;
        $this->groupBySeparator();
        $this->counterSpan();
        return $this;
    }

    public function getListHeader()
    {

        $html = '';
        $html .= $this->getSelectAbleHeader();
        $nF = 0; //  field number
        foreach ($this->property['field'] as $_code => $_item) {
            $html .= "<th class=\"middle-vertical-align\">\n";
            $html .= $this->getHeaderItemLabel($_item, $_code);
            $html .= $this->getOrderableField($_code);
            $html .= "</th>\n";
            $nF++;
        }
        echo $html;
    }

    /**
     * Gestione etichetta per header delle liste
     * se non presente nelle traduzioni prende
     * il valore del config
     * @param $_item
     * @param $_code
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    function getHeaderItemLabel($_item, $_code)
    {
        $itemProperty = is_array($_item) ? $_code : $_item;
        $full_label_path = 'admin.label.' . $itemProperty;
        return (\Lang::has($full_label_path)) ? trans($full_label_path) : ucwords(str_replace('_', ' ', $itemProperty));
    }

    /**
     * @return string
     */
    protected function getSelectAbleHeader()
    {
        return ($this->property['selectable']) ? "<th class=\"selectable-column\"></th>\n" : '';
    }




    /**
     * check if the model list
     * has an action
     * @return bool
     */
    function hasAction()
    {
        return collect($this->action_list)->some(function ($value, $key) {
           return data_get($this->property, $value,'');

        });
    }
}
