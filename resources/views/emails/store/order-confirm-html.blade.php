@extends('emails.master.html')
@section('content')

    <h2 class="order-step-title">3. {{ trans('store.cart.confirm') }}</h2>
    <div class="row">
        <div class="col-6">
            <h5 class="order-step-resume-title"><b>{{ trans('store.order.shipping') }}</b></h5>
            {!!  $cart->shipping_address->display('<br>')!!}
        </div>
        <div class="col-6">

        </div>

    </div>

    <div class="row">
        <div class="col-12 mt-3">
            <h5 class="order-step-resume-title"><b>{{ trans('store.payment.method') }}:</b> {{$cart->payment_method->title}}
            </h5>

        </div>
    </div>

    <h5>{{__('store.order.number')}} #1234546789</h5>
    {{ trans('store.order.data') }}: 31/12/2020
    <table  class="" border="0" cellpadding="2" cellspacing="0" width="570px">
        <tbody>
        <tr>
            <td width="45%">
                <h5 class="order-step-resume-title"><b>{{ trans('store.order.shipping') }}</b></h5>
                {!!  $order->shipping_address->display('<br>')!!}
            </td>
            <td width="10%"></td>
            <td width="45%">
                <h5 class="order-step-resume-title"><b>{{ trans('store.order.billing') }}</b></h5>
                {!! optional($order->display_billing_address)->display('<br>')!!}
            </td>
        </tr>
        </tbody>
    </table>

    <table  class="" border="1" cellpadding="2" cellspacing="0" width="570px">
        <thead>
        <tr>
            <th>Codice</th>
            <th>Descrizione</th>
            <th width="80px" class="text-center" align="center">Quantità</th>
            <th class="text-center">Prezzo</th>
            <th class="text-center">Prezzo Totale</th>
        </tr>
        </thead>
        <tbody>
        <tr id="table_row_372676">
            <td> 506725</td>
            <td> FAEMINA DICHTUNG KIT</td>
            <td class="text-center" width="80px" align="center">1</td>
            <td class="text-right"><span class="item-price">11,00</span></td>
            <td class="text-right"><span id="item_total_price_372676" class="item-total-price">11,00</span></td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td id="cart-big-total" colspan="9" align="right">Totale Ordine: € 11,00</td>
        </tr>
        </tfoot>
    </table>
@endsection
