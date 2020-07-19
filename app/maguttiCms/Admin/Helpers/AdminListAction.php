<?php


namespace App\maguttiCms\Admin\Helpers;

/**
 * Trait AdminListAction
 * @package App\maguttiCms\Admin\Helpers
 */
trait AdminListAction
{

    protected $action_list = ['edit', 'delete', 'view', 'copy', 'impersonate'];

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

    function Actions()
    {
        return collect($this->action_list);
    }
}