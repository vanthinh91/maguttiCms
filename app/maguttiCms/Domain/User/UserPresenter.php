<?php


namespace App\maguttiCms\Domain\User;


trait UserPresenter
{
   function getNameAttribute(){

        return $this->firstname.' '.$this->lastname;
   }
}