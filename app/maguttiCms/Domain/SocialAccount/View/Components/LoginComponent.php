<?php

namespace App\maguttiCms\Domain\SocialAccount\View\Components;

use App\Address;
use Illuminate\View\Component;

class LoginComponent extends Component
{

    /**
     * @var string
     */
    public $label;

    /**
     * Create a new component instance.
     *
     *
     * @param string $label
     */
    public function __construct(string $label)
    {
        //
         $this->label = $label;
     }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('magutti_social::login');
    }
}
