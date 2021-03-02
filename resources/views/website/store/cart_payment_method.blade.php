<h2 class="order-step-title">2. {{ trans('store.payment.method') }}</h2>
<form class="mb-4" action="{{url_locale('/cart/payment')}}" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-12">
            @foreach ($payment_methods as $_method)
                <div class="form-radio">
                    <input type="radio" required  name="payment_method_id" value="{{$_method->id}}" {{($cart->payment_method_id==$_method->id)?'checked':''}}>
                    <label>{{$_method->title}}</label>
                </div>
            @endforeach
            <x-website.ui.form-error-label class="pt-1" field="payment_method_id" srequired/>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-accent ">
            {{trans('store.cart.step.next_confirm')}}
        </button>
    </div>
</form>


