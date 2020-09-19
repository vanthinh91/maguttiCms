<?php

namespace App\View\Components\Website\partials;

use Illuminate\View\Component;

class page-content extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.partials.page-content');
    }
}
