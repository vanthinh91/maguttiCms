@extends('website.app')
@section('content')

    <main class="main-cart">
        <div class="container">
            <div class="border p-4">
                <div class="h3 text-primary">
                    {!!  __('store.order.success') !!}<span class="text-accent"> {{$order->order_reference}} </span>
                </div>
                {!!   $order->orderFeedback(optional($payment->payment_method)->description)!!}
                <p>
                    {{__('store.order.info')}}
                    <span class="text-accent">{{$order->order_reference}}</span>
                </p>
            </div>
            @include('flash::notification')
        </div>
    </main>
@endsection
