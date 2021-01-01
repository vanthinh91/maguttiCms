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
        return $this->belongsTo('App\Media', 'image', 'id');
    }
    public function docMedia()
    {
        return $this->belongsTo('App\Media', 'doc', 'id');
    }

    public function hasGallery()
    {
        return $this->gallery()->count();
    }

}