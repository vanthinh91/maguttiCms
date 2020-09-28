<?php


namespace App\Console\Commands\Support\Model\support;

/**
 * Trait StubTypeResolver
 * @package App\Console\Commands\Support\Model\support
 */
trait StubTypeResolver
{

    function resolveStub($field,$type){
        if($this->stubFieldExist($field))  return file_get_contents(__DIR__ . "/stubs/fieldspecs/{$field}.stub");
        return file_get_contents(__DIR__ . "/stubs/fieldspecs/{$type}.stub");
    }

    function  stubFieldExist($field){
         return file_exists( __DIR__ . "/stubs/fieldspecs/{$field}.stub");
    }
}