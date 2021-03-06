@extends('emails.master.html')
@section('content')
        <h3 class="order-step-title">{{__('store.order.number')}}: {{$order->reference}}</h3>
        {{ trans('store.order.date') }}: {{$order->created_at->format('d-m-Y')}}
        <table class="" border="0" cellpadding="2" cellspacing="0" width="570px">
            <tbody>
            <tr>
                <td width="45%">
                    <h4 class="order-step-resume-title"><b>{{ trans('store.order.shipping') }}</b></h4>
                    {!!  $order->shipping_address->display('<br>')!!}
                </td>
                <td width="10%"></td>
                <td width="45%">
                    @if($order->display_billing_address))
                    <h4 class="order-step-resume-title"><b>{{ trans('store.order.billing') }}</b></h4>
                    {!! optional($order->display_billing_address)->display('<br>')!!}
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
        <h4>{{__('store.order.resume')}}</h4>
        <table class="" border="1" cellpadding="2" cellspacing="0" width="570px">
            <thead>
            <tr>
                <th>{{__('store.cart.table.name')}}</th>
                <th width="80px" class="text-center" align="center">{{__('store.cart.table.quantity')}}</th>
                <th class="text-center">{{__('store.cart.table.price')}}</th>
                <th class="text-center">{{__('store.cart.table.total')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->order_items()->get() as $item)
            <tr id="table_row_{{$item->id}}">

                <td>{!! $item->product_description  !!}</td>
                <td class="text-center" width="80px" align="center">{!! $item->quantity  !!}</td>
                <td class="text-right" align="right"><span class="item-price">{{StoreHelper::formatPrice($item->price)}}</span></td>
                <td class="text-right" align="right"><span id="item_total_price_{{$item->id}}" class="item-total-price">{{StoreHelper::formatPrice($item->total_price)}}</span></td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td id="cart-big-total" colspan="9" align="right">
                    <span>{{ __('store.order.products_cost') }}: {{StoreHelper::formatPrice($order->products_cost)}}</span>
                    <br>
                    @if($order->discount_amount>0)
                    <span>{!!   $order->getDiscountLabel()!!}: {{StoreHelper::formatPrice($order->discount_amount)}}</span>
                    <br>
                    @endif
                    <span>{{ __('store.cart.total') }}&nbsp;({{ __('store.cart.with_tax') }}): {{ StoreHelper::formatPrice($order->total_cost) }}</b></span>
                </td>
            </tr>
            </tfoot>
        </table>

        <table class="" border="0" cellpadding="2" cellspacing="0" width="570px">
            <tbody>
            <tr>
                <td width="100%">
                    <p><b>{{ trans('store.payment.method') }}:</b> {{$order->payment_method_display}}</p>
                    @if($order->payment->payment_method_id=App\PaymentMethod::BANK_TRANSFER)
                        {!!   $order->orderFeedback(optional($order->payment->payment_method)->description)!!}
                    @endif
                </td>
            </tr>
            </tbody>
        </table>


@endsection
