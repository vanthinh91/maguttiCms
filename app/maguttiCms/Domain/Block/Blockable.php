<?php

namespace App\maguttiCms\Domain\Block;

trait Blockable
{
    /**
     * GET ALL MODEL BLOCKS
     * @return mixed
     */
    public function blocks()
    {
        return $this->morphMany('App\Block', 'model');
    }
    /**
     * GET active and sorted blocks by sort ascending order
     *
     */

    public function blocks_sorted()
    {
        return $this->blocks()->sorted();
    }


    /**
     * GET MODEL BLOCK BY ID
     * @param $id
     * @return mixed
     */
    public function blockById($id)
    {

        return $this->block($id);
    }

    public function block($id,$field='id')
    {
        return $this->blocks()->where($field,$id)->first();
    }
    public function hasBlocks()
    {
        return $this->blocks()->count();
    }
}