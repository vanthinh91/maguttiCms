<?php


namespace App\maguttiCms\Admin\Decorators;


use Carbon\Carbon;
use Illuminate\Support\Str;

trait AdminListComponentableTrait
{

    function hasComponent($type)
    {
        $sample = new \ReflectionClass($this);
        if ($sample->hasMethod($this->resolveMethodName($type))) return true;
        if ($this->componentClassExist($type)) return true;
        return false;
    }

    function makeComponent($article, $itemProperty)
    {

        if ($this->componentClassExist($itemProperty['type'])) {
            $componentClassName = $this->resolveComponentClassNamespace($itemProperty['type']);
            return (new $componentClassName($article, $itemProperty))->setPageConfig($this->property)->render();
        }
        return $this->{$this->resolveMethodName($itemProperty['type'])}($article, $itemProperty);
    }


    function resolveMethodName($type)
    {
        return 'make' . ucfirst(Str::camel($type));
    }

    function resolveComponentClassNamespace($type)
    {
        return "App\maguttiCms\Admin\Decorators\AdminList" . ucfirst(Str::camel($type)) . "Component";
    }

    function componentClassExist($type)
    {
        return class_exists($this->resolveComponentClassNamespace($type));
    }
}