<?php
/**
 * Created by PhpStorm.
 * User: web01
 * Date: 2019-10-15
 * Time: 09:09
 */

namespace App\maguttiCms\Admin\Decorators;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

abstract class AdminListComponent
{
    public $model;      //oggetto corrente
    public $item;       //properieta dell 'elemento corrente dal config della lista
    public $pageConfig;  //proprietà del model corrente  preso dal config della lista
    public $fieldspec;

    public $id;
    public $field;
    public $value;
    public $html;
    public $isEditable;


    abstract function render();

    public function __construct($model,$item)
    {
        $this->item = $item;

        $this->setModel($model)->setField($this->item['field']);
        $this->setFieldspec();
    }

    public function setFieldspec()
    {
        $this->fieldspec = data_get($this->model->getFieldspec(), $this->field);
        return $this;
    }

    /**
     * @param mixed $model
     * @return AdminListComponent
     */
    protected function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value = $this->model->{$this->field};
    }
     /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param mixed $pageConfig
     * @return AdminListComponent
     */
    public function setPageConfig($pageConfig)
    {
        $this->pageConfig = $pageConfig;
        return $this;
    }

    /**
     * @param mixed $field
     * @return AdminListComponent
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @return mixed
     */
    public function isEditable()
    {
        return data_get($this->item, 'editable');
    }

    public function getItemProperty($property)
    {
        return data_get($this->item, $property);
    }

    public function getConfigProperty($property)
    {
        return data_get($this->pageConfig, $property);
    }

    public function getFieldSpecProperty($property)
    {
        return data_get($this->fieldspec, $property);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->model->id;
    }

    protected function buildViewData()
    {
        $viewData = [];

        foreach ((new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $viewData[$property->getName()] = $property->getValue($this);
        }
        foreach ((new ReflectionClass($this))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if (Str::startsWith($method->getName(), '__')) {
                //return true;
            }
            elseif (! in_array($name = $method->getName(), ['loadView', 'view','setPageConfig'])) {
                //$viewData[$name] = $this->$name();
            }
        }

        //$obj = new App\LaraCms\Admin\Decorators\AdminListBooleanComponent;
        return $viewData;
    }
}