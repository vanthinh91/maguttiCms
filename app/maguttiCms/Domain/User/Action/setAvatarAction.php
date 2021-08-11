<?php

namespace App\maguttiCms\Domain\User\Action;


use App\User;

class setAvatarAction
{
    protected User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    function execute($avatar)
    {
        return $this->user->update(['avatar' => $avatar]);
    }
}