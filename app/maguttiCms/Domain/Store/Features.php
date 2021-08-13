<?php

namespace App\maguttiCms\Domain\Store;

class Features
{

    /**
     * Determine if the given feature is enabled.
     *
     * @param  string  $feature
     * @return bool
     */
    public static function enabled(string $feature)
    {
        return in_array($feature, config('maguttiCms.store.features', []));
    }

    /**
     * Determine if the feature is enabled and has a given option enabled.
     *
     * @param  string  $feature
     * @param  string  $option
     * @return bool
     */
    public static function optionEnabled(string $feature, string $option)
    {
        return static::enabled($feature) &&
            config("maguttiCms.store.{$feature}.{$option}") === true;
    }

    /**
     * Determine if the store is enabled.
     *
     */
    public static function isStoreEnabled(){
          return config("maguttiCms.store.enabled") === true;
    }

    /**
     * Determine if shop as free shipping for all products.
     *
     */
    public static function hasFreeShipping(){
        return config("maguttiCms.store.shipping.enabled");
    }

    /**
     * Determine if product price can be displayed.
     *
     */
    public static function showPrice(){
        if(!self::isStoreEnabled()) return false;
        //price are only for  authenticated user
        if(config('maguttiCms.store.private_prices') && !auth_user()) return false;
        return true;
    }

    /**
     * Determine if shop show discount / promotion banner.
     *
     */
    public static function hasShopBanner(){
        return static::enabled(static::shopBanner());
    }

    public static function shopBanner()
    {
        return 'shop_banner';
    }
}