<?php
namespace App\maguttiCms\Builders;


use Illuminate\Database\Eloquent\Builder;

class LaraCmsBuilder extends Builder
{
    public  function status($status){
        return $this->where('is_active',$status);
    }
    public  function active(){
        return $this->status(1);
    }
    public  function inactive(){
        return $this->where('is_active','!=',1)->orWhereNull('status');
    }
    public function published() {
        return $this->where('pub', 1);
    }
}
