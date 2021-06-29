<?php


namespace App\maguttiCms\Domain\Media\Action;


use App\Media;

/**
 * Class DeleteMediaAction
 * @package App\maguttiCms\Domain\Media\Action
 */
class DeleteMediaAction
{

    private Media $media;

    public function __construct(Media $media)
    {
        $this->media = $media;

    }
    function execute()
    {
        if($this->media->canBeDeleted()){
            // delete media from db;
            $this->media->delete();
            // delete media from  disk
            return (new DeleteMediaFromDisk($this->media))->execute();
        }

    }
}