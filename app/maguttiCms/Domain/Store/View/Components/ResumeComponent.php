<?php

namespace App\maguttiCms\Domain\Store\View\Components;

use App\Address;
use App\Order;
use Illuminate\View\Component;

class ResumeComponent extends Component
{

    /**
     * @var Order
     */
    public $order;

    public function __construct(Order $order)
    {

        $this->order = $order;
    }


    public function render()
    {
        return view('magutti_store::partials.resume');
    }
}
