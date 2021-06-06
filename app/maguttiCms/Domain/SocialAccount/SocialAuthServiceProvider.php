<?php

namespace App\maguttiCms\Domain\SocialAccount;




use Illuminate\Support\ServiceProvider;


use App\maguttiCms\Domain\SocialAccount\View\Components\ButtonComponent;
use App\maguttiCms\Domain\SocialAccount\View\Components\HeaderComponent;
use App\maguttiCms\Domain\SocialAccount\View\Components\ItemsComponent;
use App\maguttiCms\Domain\SocialAccount\View\Components\LoginComponent;

/**
 * Class StoreServiceProvider
 * @package App\maguttiCms\Domain\Store
 */
class SocialAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this
            ->registerBladeClasses()
            ->registerPublishables();

    }

    public function boot() : void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'magutti_social');
        $this->loadViewComponentsAs('magutti_social', [
            ItemsComponent::class,
            LoginComponent::class,
            HeaderComponent::class,
            ButtonComponent::class,

        ]);
        $this->publishes([
            __DIR__ . 'resources/views' => resource_path('views/vendor/magutti_social'),
        ]);
    }

    protected function registerPublishables(): self
    {
        return $this;
    }


    protected function registerBladeClasses(): self
    {
        return $this;
    }
}