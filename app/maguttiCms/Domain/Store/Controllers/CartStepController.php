<?php


namespace App\maguttiCms\Domain\Store\Controllers;

use App\Http\Controllers\Controller;
use App\maguttiCms\Tools\StoreHelper;
use Illuminate\Support\Facades\Redirect;


class CartStepController extends Controller
{

    public function __construct() {

    }

    public function getCart() {
        return  StoreHelper::getSessionCart();

    }

    function handleMissingStep()
    {
        if(auth_user()){
            return redirect(url_locale('/cart'));
        }
        return Redirect::to(url_locale('/order-login'));
    }

    function shippingHasError($result)
    {
        return (data_get($result,'status')=='KO');
    }
}