@extends('website.app')
@section('content')
    <x-website.partials.page-header :title="trans('store.cart.title')"/>
    <section>
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card order-info box-shadow p-2"></div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card cart-summary box-shadow p-2">


                        <div class="cart-summary-line cart-item">
                            <span class="label">{{ $cart->cart_items_count }} {{ __('store.cart.number_of_items') }} </span>
                            <span class="value"></span>
                        </div>
                        <!-- Card summary details -->
                        <div class="cart-summary-detail mb-2">
                            <a class="text-accent d-flex justify-content-between" data-toggle="collapse"
                               href="#cartSummaryDetail"
                               aria-expanded="false" aria-controls="cartSummaryDetail">
                                {{ __('store.cart.show_detail') }} <span><i class="fas fa-chevron-down pt-1"></i></span>
                            </a>

                            <div class="collapse" id="cartSummaryDetail">
                                <ul class="media-list">
                                    @foreach($cart->cart_items()->get() as $item)
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="http://prestashop.test/index.php?id_product=2&amp;id_product_attribute=9&amp;rewrite=brown-bear-printed-sweater&amp;controller=product#/1-dimensione-s"
                                                   title="{{$item->product->title}}">
                                                    <img class="media-object"
                                                         src="https://magutticms.test/media/images/cache/spazzola_jpeg_64_48_cover_60.jpg"
                                                         alt="{{$item->product->title}}">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <span class="product-name d-flex ">{{$item->product->title}}</span>
                                                <div class="d-flex justify-content-between">
                                                    <div class="product-quantity text-secondary">
                                                        x{{$item->quantity}}</div>
                                                    <div class="product-price font-weight-bold">    {{StoreHelper::formatPrice($item->product->price * $item->quantity)}}</div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>


                        </div>
                        <div class="cart-summary-line cart-product-total">
                            <span class="label">{{ __('store.order.products_cost') }}</span>
                            <span class="value">{{ StoreHelper::formatCartTotal($cart) }}</span>
                        </div>
                        @if(Storehelper::getDiscountPercentage($cart->discount_code ))
                            <div class="cart-summary-line cart-discount">
                                <span class="label">{{ __('store.order.discount.title') }}<br><strong>{{ $cart->discount_code }}</strong></span>
                                <span class="value">{{ StoreHelper::formatPrice(Storehelper::getDiscountPercentage($cart->discount_code )) }}<br><a
                                            href="" @click.prevent="deleteCartCoupon"
                                            class="text-danger d-none">{{ __('store.order.discount.delete') }}</a></span>
                            </div>
                        @endif
                        <div class="cart-summary-line cart-ship d-none">
                            <span class="label">{{ __('store.order.shipping_cost') }}</span>
                            <span class="value">{{ StoreHelper::formatPrice(StoreHelper::calcShipping($cart,20)) }}</span>
                        </div>

                        <div class="cart-summary-totals">
                            <div class="cart-summary-line cart-total">
                                <span class="label">{{ __('store.cart.total') }}&nbsp;({{ __('store.cart.with_tax') }})</span>
                                <span class="value">{{ StoreHelper::formatPrice($cart->cartGrandTotal()) }}</span>
                            </div>
                        </div>


                    </div>
                    <!-- Card Discount -->
                    <coupon-component></coupon-component>
                </div>
            </div>

        </div>
    </section>
@endsection
