<?php

namespace App\maguttiCms\Admin;
use Carbon\Carbon;
Use Form;
Use App;
use Illuminate\Support\Str;

/**
 * Class AdminForm
 * @package App\LaraCms\Admin
 */
class AdminList
{

    /**
     * @var
     */
    protected $html;
    /**
     * @var
     */
    protected $property;


    /**
     * @param $property
     * @return $this
     */
    public function initList($property)
    {
        $this->html = "";
        $this->property = $property;
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
     * @param $i
     * @return string
     */
    protected function getOrderableField($i)
    {
        $html = '';
        if (array_key_exists($i, $this->property['field'])) {
            $item = $this->property['field'][$i];
            if ($this->fieldIsOrderable($item)) {
                $curField = (is_array($item)) ? data_get($item, 'order_field', $item['field']) : $item;
                $html .= " <a href=\"?orderBy=$curField&orderType=desc\"><i class=\"fa fa-arrow-down\" aria-hidden=\"true\"></i></a>\n";
                $html .= " <a href=\"?orderBy=$curField&orderType=asc\"><i class=\"fa fa-arrow-up\" aria-hidden=\"true\"></i></a>\n";
            }
        }
        return $html;
    }

    /**
     * @param $item
     * @return bool
     */
    protected function fieldIsOrderable($item)
    {
        return  $item['orderable'] ?? false;
    }

    function hasComponent($type){
        $sample =  new \ReflectionClass($this);
        if($sample->hasMethod($this->resolveMethodName($type))) return true;
        if($this->componentClassExist($type)) return true;
        return false;
    }
    function makeComponent($article,$itemProperty){

        if($this->componentClassExist($itemProperty['type'])){
            $componentClassName = $this->resolveComponentClassNamespace($itemProperty['type']);
            return (new $componentClassName($article,$itemProperty))->setPageConfig($this->property)->render();
        }
        return  $this->{$this->resolveMethodName($itemProperty['type'])}($article,$itemProperty);
    }

    function makeDate($article,$itemProperty){
        return Carbon::parse($article->{$itemProperty['field']})->format('d/m/Y');
    }

    function makeColor($article,$itemProperty){
        return "<div class=\"color\" style=\"background-color:".$article->{$itemProperty['field']}."\"></div>";
    }

    function makeLocale($article,$itemProperty){
        $value = $article->{$itemProperty['field']};
        return "<img class=\"flag\" 
                     src=\"".asset("website/images/flags/".$value.".png")."\" 
                     alt=\"".$value." flag\">";
    }

    function resolveMethodName($type){
        return 'make'.ucfirst(Str::camel($type));
    }

    function resolveComponentClassNamespace($type){
        return  "App\LaraCms\Admin\Decorators\AdminList".ucfirst(Str::camel($type))."Component";
    }

    function componentClassExist($type){
        return class_exists($this->resolveComponentClassNamespace($type));
    }

    function hasAction(){

        return true;

    }
}
