<?php

namespace App\View\Components\Website\Widgets;

use App\Article;
use Illuminate\View\Component;
use PhpParser\Node\Expr\Cast\Object_;

class BaseWidget extends Component
{
    public $item;
    public $class;
    public $classCaption;
    public $color;

    /**
     * Create a new component instance.
     *
     * @param $item
     */
    public function __construct(Article $item,$class,$classCaption='',$color='')
    {
        $this->item = $item;
        $this->class = $class;
        $this->classCaption = $classCaption;
        $this->color = $color;
    } //


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.widgets.design');
    }

    public function blocks()
    {
        return $this->item->blocks()->get();
    }
}
