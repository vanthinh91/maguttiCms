<?php


namespace App\maguttiCms\Domain\Store\Payment;


trait PaymentMethodPresenter
{
  function hasFee(){
      return ($this->fee)??false;
  }
}