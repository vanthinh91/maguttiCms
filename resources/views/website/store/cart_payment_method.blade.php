<h2 class="login-box-title text-primary mt-5">{{ trans('store.payment.method') }}</h2>
<form action="{{url_locale('/order-payment/')}}" method="post">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-12 col-sm-6">
            @foreach ($payment_methods as $_method)
                <div class="form-radio">
                    <input type="radio" name="payment_method_id" value="{{$_method->id}}">
                    <label>{{$_method->title}}</label>
                    {{ $errors->first('privacy') }}
                </div>
            @endforeach
        </div>
        <div class="col-12 col-sm-6">
            <button type="submit" class="btn btn-primary pull-right">
                {{trans('store.payment.pay')}}
            </button>
        </div>
    </div>
</form>


