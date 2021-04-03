<?php


namespace App\maguttiCms\Website\Controllers\Store;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\maguttiCms\Tools\StoreHelper;
use App\maguttiCms\Domain\Store\Notifications\NewOrderNotification;

/**
 * Class OrderResultController
 * @package App\maguttiCms\Website\Controllers\Store
 */
class OrderResultController extends Controller
{


    public function view($token)
    {
        $user = Auth::user();

        $order = StoreHelper::getOrderByToken($token);

        if ($order) {
            $payment = $order->payment;
            $user->notify(new NewOrderNotification($order));

            return view('magutti_store::order.confirm', compact('order', 'payment'));
        }
        else {
            return Redirect::to('/');
        }
    }

}
