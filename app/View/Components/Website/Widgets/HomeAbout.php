<?php

namespace App\View\Components\Website\Widgets;

class HomeAbout extends BaseWidget
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.widgets.home_about');
    }
}
