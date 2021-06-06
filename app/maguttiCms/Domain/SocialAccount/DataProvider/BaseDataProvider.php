<?php


namespace App\maguttiCms\Domain\SocialAccount\DataProvider;


use App\maguttiCms\Domain\SocialAccount\Contracts\DataProvider;

/**
 * Class BaseDataProvider
 * @package App\maguttiCms\Domain\SocialAccount\DataProvider
 */
class BaseDataProvider implements DataProvider
{

    /**
     * @param $providerUser
     * @return array
     */
    function mapDataObject($providerUser): array
    {

        return [
            'firstname' => $providerUser->name,
            'lastname'  => '',
            'is_active' => 1,
            'email'     => $providerUser->email
        ];
    }
}