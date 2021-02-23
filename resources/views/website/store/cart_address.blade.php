

<h2 class="login-box-title text-primary">{{trans('store.order.addresses')}}</h2>

<form class="" action="" method="post">
    {{ csrf_field() }}
    <h3>{{trans('store.order.billing')}}</h3>
    <div class="row form-group">

        <div class="col-12 col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="{{ trans('website.firstname') }}" name="firstname"
                       value="{{ old('firstname') }}" required>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="{{ trans('website.lastname') }}" name="lastname"
                       value="{{ old('lastname') }}" required>
            </div>
        </div>

        <div class="col-12 col-sm-8 form-group">
            <input class="form-control" type="text" name="street" value="{{ old('street') }}"
                   placeholder="{{trans('store.address.fields.street')}}" required>
        </div>
        <div class="col-12 col-sm-4 form-group">
            <input class="form-control" type="text" name="number" value="{{ old('number') }}"
                   placeholder="{{trans('store.address.fields.number')}}" required>
        </div>

        <div class="col-12 col-sm-8 form-group">
            <input class="form-control" type="text" name="city" value="{{ old('city') }}"
                   placeholder="{{trans('store.address.fields.city')}}" required>
        </div>

        <div class="col-12 col-sm-4 form-group">
            <input class="form-control" type="text" name="zip_code" value="{{ old('zip_code') }}"
                   placeholder="{{trans('store.address.fields.zip_code')}}" required>
        </div>


        <div class="col-12 col-sm-6 form-group">
            <input class="form-control" type="text" name="province" value="{{ old('province') }}"
                   placeholder="{{trans('store.address.fields.province')}}" required>
        </div>
        <div class="col-12 col-sm-6 form-group">
            <select class="form-control" name="country_id" required>
                @foreach ($countries as $_country)
                    <option value="{{$_country->id}}"
                            @if(old('country-id') == $_country->id) selected="true" @endif>{{$_country->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-sm-6">
            <input class="form-control form-group" type="text" name="phone" value="{{ old('phone') }}"
                   placeholder="{{trans('store.address.fields.phone')}}">
        </div>
        <div class="col-12 col-sm-6">
            <input class="form-control form-group" type="text" name="mobile" value="{{ old('mobile') }}"
                   placeholder="{{trans('store.address.fields.mobile')}}">
        </div>
        <div class="col-12 col-sm-6">

            <input class="form-control form-group" type="email" name="email"
                   value="{{ (old('email'))? old('email') : optional(auth()->guard()->user())->email}}"
                   placeholder="{{trans('store.address.fields.email')}}">
        </div>
        <div class="col-12 col-sm-6 form-group">
            <input class="form-control" type="text" name="vat" value="{{ old('vat') }}"
                   placeholder="{{trans('store.address.fields.vat')}}">
        </div>
    </div>
    <h3>{{trans('store.order.shipping')}}</h3>
    <div class="row form-group">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="{{ trans('website.firstname') }}" name="firstname"
                       value="{{ old('firstname') }}" required>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="{{ trans('website.lastname') }}" name="lastname"
                       value="{{ old('lastname') }}" required>
            </div>
        </div>

        <div class="col-12 col-sm-8 form-group">
            <input class="form-control" type="text" name="street" value="{{ old('street') }}"
                   placeholder="{{trans('store.address.fields.street')}}" required>
        </div>
        <div class="col-12 col-sm-4 form-group">
            <input class="form-control" type="text" name="number" value="{{ old('number') }}"
                   placeholder="{{trans('store.address.fields.number')}}" required>
        </div>

        <div class="col-12 col-sm-8 form-group">
            <input class="form-control" type="text" name="city" value="{{ old('city') }}"
                   placeholder="{{trans('store.address.fields.city')}}" required>
        </div>

        <div class="col-12 col-sm-4 form-group">
            <input class="form-control" type="text" name="zip_code" value="{{ old('zip_code') }}"
                   placeholder="{{trans('store.address.fields.zip_code')}}" required>
        </div>


        <div class="col-12 col-sm-6 form-group">
            <input class="form-control" type="text" name="province" value="{{ old('province') }}"
                   placeholder="{{trans('store.address.fields.province')}}" required>
        </div>
        <div class="col-12 col-sm-6 form-group">
            <select class="form-control" name="country_id" required>
                @foreach ($countries as $_country)
                    <option value="{{$_country->id}}"
                            @if(old('country-id') == $_country->id) selected="true" @endif>{{$_country->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-sm-6">
            <input class="form-control form-group" type="text" name="phone" value="{{ old('phone') }}"
                   placeholder="{{trans('store.address.fields.phone')}}">
        </div>
        <div class="col-12 col-sm-6">
            <input class="form-control form-group" type="text" name="mobile" value="{{ old('mobile') }}"
                   placeholder="{{trans('store.address.fields.mobile')}}">
        </div>
        <div class="col-12 col-sm-6">

            <input class="form-control form-group" type="email" name="email"
                   value="{{ (old('email'))? old('email') : optional(auth()->guard()->user())->email}}"
                   placeholder="{{trans('store.address.fields.email')}}">
        </div>
        <div class="col-12 col-sm-6 form-group">
            <input class="form-control" type="text" name="vat" value="{{ old('vat') }}"
                   placeholder="{{trans('store.address.fields.vat')}}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        {{trans('store.address.save')}}
    </button>
</form>
