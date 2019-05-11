<?php namespace App\maguttiCms\Admin;
use Form;
use App;

/**
 * Class AdminTree
 * @package App\maguttiCms\Admin
 */
class AdminFormComponent  {

    protected  $property;
    protected  $formObject;
    protected  $html;
    protected  $modelName;
    public function __construct($formObject)
    {
        $this->formObject = $formObject;
        $this->setProperty($this->formObject->getProperty());
    }

    public function setProperty($property)
    {
        $this->property = $property;
        return $this;
    }
}
