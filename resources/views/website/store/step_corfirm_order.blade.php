@extends('website.app')
@section('content')
    <x-website.partials.page-header :title="trans('store.cart.title')"/>
    <section>
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card order-step box-shadow p-2">
                        @include('website.store.cart_step')
                        @include('website.store.cart_confirm')
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    @include('website.store.cart_products_widget')
                </div>
            </div>

        </div>
    </section>
@endsection
