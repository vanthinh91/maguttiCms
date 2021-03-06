@extends('admin.master')
@section('content')

<?php $order = $article ;?>

    @include('admin.common.action-bar')
    <main id="edit-main" class="container-fluid">
        <h1>{{__('store.order.number')}}: {{$article->reference}}</h1>

        <div class="row">
            <div class="col-12 col-sm-8">
                <div class="card">

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#content_tab" class="nav-link active" data-toggle="tab" role="tab" aria-controls="content" aria-selected="true">
                                {{__('store.order.number')}}: {{$article->reference}} -  {{ trans('store.order.date') }}: {{$order->created_at->format('d-m-Y')}}
                            </a>
                        </li>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="content_tab" role="tabpanel" aria-labelledby="content_tab">


                            <table class="" border="0" cellpadding="2" cellspacing="0" width="100%">
                                <tbody>
                                <tr>
                                    <td width="45%">
                                        <h4 ><b>{{ trans('store.order.shipping') }}</b></h4>
                                        {!!  $order->shipping_address->display('<br>')!!}
                                    </td>
                                    <td width="10%"></td>
                                    <td width="45%">
                                        @if($order->billing_address_id)
                                            <h4 ><b>{{ trans('store.order.billing') }}</b></h4>
                                            {!! optional($order->billing_address)->display('<br>')!!}
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <h6><b>{{ trans('store.payment.method') }}:</b></h6>
                            {{$order->payment_method_display}} -
                            {{ ($order->payment->is_paid)? trans('store.payment.paid'):trans('store.payment.unpaid')}}
                            @if($order->payment->transaction)
                            {{__('admin.label.payment_transaction')}} :{{$order->payment->transaction}}
                            @endif
                            <h4>{{__('store.order.resume')}}</h4>
                            <table class="" border="1" cellpadding="2" cellspacing="0" width="100%">
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
                                        <p>{{ __('store.order.products_cost') }}: {{StoreHelper::formatPrice($order->products_cost)}}</p>

                                        @if($order->discount_amount>0)
                                            <p>{!!$order->getDiscountLabel()!!}: {{StoreHelper::formatPrice($order->discount_amount)}}</p>

                                        @endif
                                        <p>{{ __('store.cart.total') }}&nbsp;({{ __('store.cart.with_tax') }}): {{ StoreHelper::formatPrice($order->total_cost) }}</b></p>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>


                        </div>
                    </div>
                </div>


            </div>
            <div id="right-sidebar" class="col-12 col-sm-4">
                @includeFirst(['admin.'.strtolower($pageConfig->get('model')).'.side_bar_action', 'admin.common.side_bar_action'])
            </div>
        </div>
    </main>
    <div id="info" class="hidden"></div>
    @include('admin.helper.modal_media')

    @include('admin.helper.filemanager')

@endsection
