<?php


namespace App\maguttiCms\Domain\SocialAccount\Action;


use App\User;

/**
 * Class CreateNewIdentity
 * @package App\maguttiCms\Domain\SocialAccount\Action
 */
class CreateNewIdentity
{

    private User $user;

    function handle(User $user,$providerUser,$provider){
        $this->user = $user;
        return $this->addIdentity($providerUser,$provider);
    }

    function addIdentity($providerUser,$provider){
        return $this->user->identities()->create([
            'provider_id'   => $providerUser->getId(),
            'provider' => $provider,
            'name' => $providerUser->getName(),
            'nickname' => $providerUser->getNickName(),
        ]);
    }
}