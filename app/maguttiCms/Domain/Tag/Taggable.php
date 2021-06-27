<?php


namespace App\maguttiCms\Domain\Tag;


trait Taggable
{
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function saveTags($values)
    {
        if (!empty($values)) {
            $values = array_filter($values);
            $this->tags()->sync($values);
        } else {
            $this->tags()->detach();
        }
    }
}