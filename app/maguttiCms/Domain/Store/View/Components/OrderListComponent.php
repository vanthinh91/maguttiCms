<?php

namespace App\maguttiCms\Domain\Store\View\Components;

use App\Order;
use Illuminate\View\Component;

class OrderListComponent extends Component
{

    /**
     * @var Orders
     */
    public $orders;

    public function __construct()
    {

        $this->orders = auth_user()->orders()->latest()->list()->get();;
    }


    public function render()
    {
        return view('magutti_store::order.list');
    }
}
