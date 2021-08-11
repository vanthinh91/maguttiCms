<?php

namespace App\maguttiCms\Domain\User\Action;

use App\maguttiCms\Definition\Definition;
use App\User;
use Illuminate\Support\Facades\Storage;

class deleteAvatarAction
{

    protected User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->storage = Storage::disk(Definition::USER_STORAGE_DISK);
    }

    function execute()
    {
        $this->deleteAvatarFromDisk();
        return $this->user->update(['avatar' => null]);
    }

    function deleteAvatarFromDisk()
    {
        // delete avatar if exist
        if($this->user->hasAvatar()){
            $this->storage->delete($this->user->avatar);
        }
        return false;
    }
}