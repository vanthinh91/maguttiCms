<h4 class="order-sub-step-title mt-2">{{ trans('store.payment.method') }}</h4>
<div class="row">
    <div class="col-12">
        @foreach ($payment_methods as $_method)
            <div class="payment_method">
                <input type="radio" required  name="payment_method_id" value="{{$_method->id}}" {{($cart->payment_method_id==$_method->id)?'checked':''}}>
                <label class="">{{$_method->title}}</label>
                <x-magutti_store-payment-fee-component  :paymentMethod="$_method"/>
            </div>

        @endforeach
        <x-website.ui.form-error-label class="pt-1" field="payment_method_id" srequired/>
    </div>
</div>




