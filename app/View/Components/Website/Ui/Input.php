<?php

namespace App\View\Components\Website\Ui;

use Illuminate\View\Component;

class Input extends Component
{
    public string $for;
    public string $type;

    /**
     * FormErrorLabel constructor.
     * @param $for
     */
    public function __construct($for,$type='text')
    {
        //
        $this->for = $for;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.website.ui.input');
    }
}
