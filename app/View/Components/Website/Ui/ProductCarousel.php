<?php

namespace App\View\Components\Website\Ui;

use App\Product;

class ProductCarousel extends Carousel
{
    public $item;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        //
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.ui.product-carousel');
    }

    function  carousel_items($limit=4){
        return $this->carousel_items =Product::published()->inRandomOrder()->limit($limit)->get();
    }
}
