<?php namespace App\MaguttiCms\Filter\Helper;
use Input;

trait LastUpdateTrait
{

    function scopeLastUpdated($query){
        if(Input::has('last_update') && Input::get('last_update')!='')$query->where('updated_at',">",Input::get('last_update'));
    }
}

