<?php


namespace App\maguttiCms\Website\Controllers\Store;

use App\Http\Controllers\Controller;
use App\maguttiCms\Tools\StoreHelper;


class CartStepController extends Controller
{

    public function __construct() {

    }

    public function getCart() {
        return  StoreHelper::getSessionCart();

    }


    function handleMissingStep()
    {
        return redirect(url_locale('/cart'));
    }
}