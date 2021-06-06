<?php

namespace App\maguttiCms\Domain\SocialAccount\View\Components;

use App\Address;
use Illuminate\View\Component;

class ItemsComponent extends Component
{

    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('magutti_social::items');
    }
}
