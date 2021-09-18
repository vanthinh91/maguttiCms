<?php

namespace App\View\Components\Website\Products;

use App\View\Components\Website\Media\MediaCarousel;
use Illuminate\Contracts\View\View;

class ProductGallery extends  MediaCarousel
{
    public $item;
    /**
     * @var mixed|string
     */
    public $carousel_identifier;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item,$carousel_identifier="product-gallery")
    {
        //
        $this->item = $item;
        $this->carousel_identifier = $carousel_identifier;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.website.products.product-gallery');
    }

    public function gallery()
    {
        return $this->item->gallery()->sorted()->get();
    }
}