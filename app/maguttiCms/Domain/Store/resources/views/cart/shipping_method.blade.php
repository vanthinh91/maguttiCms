@if(StoreHelper::isShippingEnabled())
<h4 class="order-sub-step-title"> {{ trans('store.shipping.method') }}</h4>

<div class="row">
    <div class="col-12">

        @foreach ($shipping_methods() as $_method)
            <div class="form-radio mb-2 my-md-0">
                <input type="radio" required name="shipping_method_id"
                       value="{{$_method->id}}" {{($cart->shipping_method_id==$_method->id)?'checked':''}}>
                <label>{{$_method->cart_label}}</label>
            </div>
        @endforeach
        <x-website.ui.form-error-label class="pt-1" field="shipping_method_id" srequired/>
    </div>
</div>
@else
    <h4 class="text-primary my-4">{{__('store.shipping.free')}}</h4>
@endif




