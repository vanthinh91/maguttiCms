<?php


namespace App\maguttiCms\Domain\Store\Shipping;


use App\Cart;
use App\maguttiCms\Domain\Store\Contracts\ShippingCalculator;


class CustomShippingCostCalculator implements ShippingCalculator
{
    protected $cart;
    private $shipping_method;

    function getCost( Cart $cart): int
    {
        $this->cart = $cart;
        return $this->getAmount();
    }

    function getAmount(): int
    {
        $this->shipping_method = $this->cart->shipping_method;
        if ($this->isFree()) return 0;
        return $this->calculate($this->cart->getTotalProductsWithDiscount());
    }

    function isFree(): bool
    {
        return $this->shipping_method->fee == 0;

    }

    function calculate($product_total): int
    {

        if ($this->shipping_method->free_shipping_from < $product_total) return 0;
        return $this->shipping_method->fee;
    }
}