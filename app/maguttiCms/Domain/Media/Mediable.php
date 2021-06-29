<?php


namespace App\maguttiCms\Domain\Media;


trait Mediable
{

    public function media()
    {
        return $this->morphMany('App\Media', 'model');
    }

    public function gallery()
    {
        return $this->media()->where('collection_name', 'images');
    }

    public function imageMedia()
    {
        return $this->belongsTo('App\Media', 'image_media_id', 'id');
    }
    public function docMedia()
    {
        return $this->belongsTo('App\Media', 'doc_media_id', 'id');
    }

    public function hasImageMedia()
    {

        return $this->imageMedia()->count();
    }

    public function hasDocMedia()
    {
        return $this->imageMedia()->count();
    }

    public function hasGallery()
    {
        return $this->gallery()->count();
    }

}