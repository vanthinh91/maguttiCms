<?php

namespace App\Console\Commands\Support\Model;

use Illuminate\Filesystem\Filesystem as Filesystem;

class AdminListResolver
{
         public function __construct()
         {
             $this->adminList = config('maguttiCms.admin.list');
         }

         function handle(){


             $path =base_path().'/config/maguttiCms/admin/list.php';

             $file = fopen($path, "r");
             dd($file);


         }
}