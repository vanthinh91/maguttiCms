<form class="mb-4" action="{{ url_locale('/cart/address') }}" method="post">
    {{ csrf_field() }}
    @include('magutti_store::form.cart_shipping_address')
    @include('magutti_store::form.cart_billing_address')
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-accent btn-xs-block">
            {{trans('store.cart.step.next_payment')}}
        </button>
    </div>
</form>