<?php

namespace App\maguttiCms\Domain\SocialAccount\View\Components;

use App\Address;
use Illuminate\View\Component;

class ButtonComponent extends Component
{

    public string $provider;
    public string $redirectTo;

    public function __construct($provider,$redirectTo='')
    {

        $this->provider = $provider;
        $this->redirectTo = $redirectTo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('magutti_social::button');
    }

    public function getUrl(){

         $url = url('/social_auth/'.$this->provider);
         if($this->redirectTo) {
             $url.= '?redirectTo='.$this->redirectTo;
         }
        return  $url;
    }
    public function  getLabel(){
        return $this->provider;
    }
}
