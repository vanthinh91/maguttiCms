@extends('website.app')
@section('content')
    <x-website.partials.page-header :title="trans('store.cart.title')"/>
    <section>
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card order-info box-shadow p-2">
                        @include('website.store.cart_step')
                        @include('website.store.cart_payment_method')
                        <h2 class="order-step-title">3. {{ trans('store.cart.confirm') }}</h2>
                    </div>

                </div>
                <div class="col-12 col-md-4">
                    @include('website.store.cart_products_widget')
                </div>
            </div>

        </div>
    </section>
@endsection
