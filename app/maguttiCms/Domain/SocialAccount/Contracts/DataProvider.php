<?php


namespace App\maguttiCms\Domain\SocialAccount\Contracts;

/**
 * Interface DataProvider
 * @package App\maguttiCms\Domain\SocialAccount\Contracts
 */
interface DataProvider
{
    function mapDataObject(array $providerUser);
}