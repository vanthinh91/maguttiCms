<?php

namespace App\maguttiCms\Domain\Store;


use Illuminate\Support\ServiceProvider;

use App\maguttiCms\Domain\Store\View\Components\ResumeComponent;
use App\maguttiCms\Domain\Store\View\Components\ShippingCostLabel;
use App\maguttiCms\Domain\Store\View\Components\CartProductsWidget;
use App\maguttiCms\Domain\Store\View\Components\ShopBannerComponent;
use App\maguttiCms\Domain\Store\View\Components\ProductDisplayPrice;
use App\maguttiCms\Domain\Store\View\Components\PaymentFeeComponent;
use App\maguttiCms\Domain\Store\View\Components\PaymentMethodComponent;
use App\maguttiCms\Domain\Store\View\Components\ShippingMethodComponent;


use App\maguttiCms\Domain\Store\View\Components\OrderListComponent;
use App\maguttiCms\Domain\Store\View\Components\OrderPaymentComponent;
use App\maguttiCms\Domain\Store\View\Components\OrderShippingComponent;

use App\maguttiCms\Domain\Store\View\Components\AddressComponent;

/**
 * Class StoreServiceProvider
 * @package App\maguttiCms\Domain\Store
 */
class StoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this
            ->registerBladeClasses()
            ->registerPublishables();
            //$this->mergeConfigFrom(__DIR__ . '/config/store.php', 'store');
    }

    public function boot() : void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'magutti_store');
        $this->loadViewComponentsAs('magutti_store', [
            AddressComponent::class,
            CartProductsWidget::class,
            ResumeComponent::class,
            OrderPaymentComponent::class,
            OrderShippingComponent::class,
            OrderListComponent::class,
            ShippingMethodComponent::class,
           ShopBannerComponent::class,
            PaymentMethodComponent::class,
            PaymentFeeComponent::class,
            ProductDisplayPrice::class,
            ShippingCostLabel::class,

        ]);
        $this->publishes([
            __DIR__ . 'resources/views' => resource_path('views/vendor/magutti_store'),
        ]);
    }

    protected function registerPublishables(): self
    {
       /* if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/store.php' => config_path('store.php'),
            ], 'config');

        }*/

        return $this;
    }


    protected function registerBladeClasses(): self
    {


        return $this;
    }
}