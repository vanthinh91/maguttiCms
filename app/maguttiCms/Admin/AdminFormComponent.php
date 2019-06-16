<?php namespace App\maguttiCms\Admin;
use Form;
use App;

/**
 * Class AdminTree
 * @package App\maguttiCms\Admin
 */
class AdminFormComponent  {

    protected $property;
    protected $formObject;
    protected $html;
    protected $modelName;
    protected $attributes;
    public function __construct($formObject)
    {
        $this->formObject = $formObject;
        $this->setProperty($this->formObject->getProperty());
    }

    public function setProperty($property)
    {
        $this->property = collect($property);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param $options
     * @return string
     */
    public function getAttributes($options)
    {

        foreach($options as $name => $value ){
            if (is_bool($value)) {
                if ($value) $this->attributes .= $name . ' ';
            } else {
                $this->attributes .= sprintf('%s="%s"', $name, $value);
            }
        };

        return $this->attributes;
    }
}
