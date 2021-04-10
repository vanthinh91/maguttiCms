@extends('website.app')
@section('content')
    <x-website.partials.page-header :title="trans('store.cart.title')"/>
    <section>
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card order-step box-shadow p-2">
                        @include('magutti_store::cart.step_menu')
                        @include('magutti_store::cart.confirm')
                        <div class="d-flex justify-content-end mt-3 d-none d-md-flex">
                            <a href="{{url_locale('order-send')}}" type="submit" class="btn btn-success">
                                {{trans('store.order.confirm')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <x-magutti_store-cart-products-widget :cart="$cart"/>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{url_locale('order-send')}}" type="submit" class="btn btn-success  btn-block">
                            {{trans('store.order.confirm')}}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
