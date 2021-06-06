<?php


namespace App\maguttiCms\Domain\SocialAccount\Action;


use App\User;
use App\SocialAccount;

/**
 * Class FindOrCreateUserAction
 * @package App\maguttiCms\Domain\SocialAccount\Action
 */
class FindOrCreateUserAction
{
   function handle($providerUser, $provider)
       {
           // prepare provider account data
           $providerAccount = [
               'provider' => $provider,
               'provider_id' => $providerUser->getId()
           ];

           // check if account already exist
           $account = SocialAccount::firstWhere($providerAccount);

           if ($account) {
               return $account->user;
           }
           // check if user already exist
           $user = User::firstWhere('email',$providerUser->getEmail());

           // or create new user
           if (! $user) $user = (new CreateUserAction())->handle($providerUser,$provider);

           // add Identity
           (new CreateNewIdentity())->handle($user,$providerUser,$provider);

           return $user;
       }


       function resolveProvider($provider){


       }

}