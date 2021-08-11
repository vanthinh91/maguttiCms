<?php


namespace App\maguttiCms\Domain\User;


use App\maguttiCms\Definition\Definition;
use Illuminate\Support\Facades\Storage;

trait UserPresenter
{
    function getNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    function getAvatarUrl()
    {
        $path = config('maguttiCms.admin.path.users_repository') . '/' . $this->avatar;
        return asset($path);
    }

    function hasAvatar()
    {
        return Storage::disk(Definition::USER_STORAGE_DISK)->exists($this->avatar);
    }
}