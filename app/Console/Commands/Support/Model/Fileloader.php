<?php

namespace App\Console\Commands\Support\Model;


use Illuminate\Filesystem\Filesystem;
class FileLoader
{
    public function save($items)
    {


        $this->files->put($file, '<?php return ' . var_export($items, true) . ';');
    }
}