<?php
/**
 * Created by PhpStorm.
 * User: web01
 * Date: 2019-10-15
 * Time: 09:09
 */

namespace App\maguttiCms\Admin\Decorators;


class  AdminListReadonlyComponent extends AdminListComponent
{

   public  function render(){
      return $this->component();
   }
}
