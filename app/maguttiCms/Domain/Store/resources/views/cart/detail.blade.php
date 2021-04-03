@extends('website.app')
@section('content')
    <x-website.partials.page-header  :title="trans('store.cart.title')"/>

    <section class="cart-list pb-0">
        @if (!$cart->isEmpty())
       <cart-resume
               :cart-data="{{$cart->cart}}"
               :cart-items="{{$cart->items}}"
               cart_url="{{ url_locale('order-submit')}}"></cart-resume>
        @else
            <div class="container">
                <div class="row my-3">
                    <div class="col-12">
                        <div class="alert alert-danger p-2">{{__('store.cart.empty')}}</div>
                    </div>

                </div>
            </div>
        @endif
    </section>




    <section class="cart-action pt-1 pb-4">
        <div class="container">
            <div id="cart-buttons"  class="d-flex justify-content-between">
                <a class="btn btn-primary" href="{{url_locale('store')}}">
                    {{trans('store.cart.back')}}
                </a>

            </div>
        </div>
    </section>
@endsection
