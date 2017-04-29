<?php namespace App\MaguttiCms\Filter\Helper;
use Input;
trait LastUpdatePodcastTrait
{

    function scopeLastUpdated($query){
        if(Input::has('last_update') && Input::get('last_update')!='')$query->where('updated_at',">",Input::get('last_update'));
        else $query->where('is_active', '=', 1);
    }

    function scopeLastModifiedPodcast($query){
        if(Input::has('podcast_last_modified') && Input::get('podcast_last_modified')!=''){

            $query->where('podcast_last_modified',">",Input::get('podcast_last_modified'));
        }
        if(Input::has('data') && Input::get('data')!=''){
            $podcast_list = explode(',',Input::get('data'));
            $query->whereIn('id',$podcast_list);
        }
    }
}

