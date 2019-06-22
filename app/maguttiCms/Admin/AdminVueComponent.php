<?php namespace App\maguttiCms\Admin;

use Form;
use App;

/**
 * Class AdminTree
 * @package App\maguttiCms\Admin
 */
class AdminVueComponent extends AdminFormComponent
{

    protected $active = "active";
    protected $component_name = '';

    /**
     * @param $value
     * @param $key
     * @return string
     */
    function getComponent($value, $key)
    {
        return $this->composeComponent($value, $key);
    }

    /**
     * @param $value
     * @param $key
     * @return string
     */
    function composeComponent($value, $key)
    {
        $data = $this->getProperty()->get('component-data');
        return "<" . $this->getComponentName() . "
                  name=\"" . $key . "\" 
                  input_text=\"" . $value . "\"
                  v-bind:data='".json_encode($data)."'
                 >
                </" . $this->getComponentName() . ">";
    }

    function composeComponentq($value, $key)
    {
        return '<' . $this->getComponentName() . ' 
                  name="' . $key . '" 
                  input_text="' . $value . '"
                  '.$this->getComponentProperties().'
                  :data=' . json_encode($this->getProperty()->get('component-data')) . '>
                </' . $this->getComponentName() . '>';
    }

    /**
     * @return string
     */
    public function getComponentName(): string
    {
        return $this->component_name = $this->getProperty()->get('component-name');
    }

    /**
     * @return string
     */
    public function getComponentProperties(): string
    {
        return ($this->getProperty()->get('component-data')) ? $this->getAttributes($this->getProperty()->get('component-data')) : '';
    }
}
