<?php


namespace App\maguttiCms\Domain\SocialAccount\DataProvider;


use App\maguttiCms\Domain\SocialAccount\Contracts\DataProvider;

/**
 * Google Data Provider
 * Class GoogleDataProvider
 * @package App\maguttiCms\Domain\SocialAccount\DataProvider
 */
class GoogleDataProvider implements DataProvider
{

    /**
     * @param $providerUser
     * @return array
     */
    function mapDataObject($providerUser): array
    {

        return [
            'firstname' => data_get($providerUser, 'given_name', $providerUser->name),
            'lastname'  => data_get($providerUser, 'family_name', null),
            'is_active' => 1,
            'email'     => $providerUser->email
        ];
    }
}