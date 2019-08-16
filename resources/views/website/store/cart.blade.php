@extends('website.app')
@section('content')

    <main class="my-5">
        <div class="container">
            <h1 class="text-primary">{{trans('store.cart.title')}}</h1>
            <cart-resume :cart-items="{{$cart_items}}"></cart-resume>
            @if ($cart_items->count())
                <hr>
                <div id="cart-buttons">
                    <a class="btn btn-primary" href="{{url_locale('store')}}">
                        {{trans('store.cart.back')}}
                    </a>
                    <a class="btn btn-primary" href="{{url_locale('order-submit')}}">
                        {{trans('store.cart.buy')}}
                    </a>
                </div>
            @endif
        </div>
    </main>
@endsection
