<?php

namespace App\maguttiCms\Domain\Store\View\Components\Cart;


use Illuminate\View\Component;

class Pino extends Component
{



    public function __construct()
    {
        dd(1);

        $this->orders = auth_user()->orders()->latest()->list()->get();;
    }


    public function render()
    {
        return 1;
    }
}
