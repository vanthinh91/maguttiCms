<form method="post" action="{{url_locale('register')}}">
    @csrf
    @if (isset($redirectTo))
        <input type="hidden" name="redirectTo" value="{{$redirectTo}}">
    @endif
    <div class="row gy-3">
        <div class="col-12 col-md-6">
            <x-website.ui.input for="firstname" placeholder="{{ trans('website.firstname') }} *" required/>
        </div>
        <div class="col-12 col-md-6">
            <x-website.ui.input placeholder="{{ trans('website.lastname') }} *" for="lastname" required/>
        </div>
        <div class="col-12">
            <x-website.ui.input type="email" placeholder="{{ trans('website.email') }} *" for="email" required/>
        </div>
        <div class="col-12">
            <x-website.ui.input type="password" for="password" placeholder="{{ trans('website.password') }} *"
               required/>
        </div>
        <div class="col-12">
            <x-website.ui.input type="password" type="password" class="form-control" for="password_confirmation"
                                placeholder="{{ trans('message.password_confirm') }}" required/>
        </div>
        <div class="col-12">
            <x-ui.alert class="mt-2 alert-color-4" >
                {{trans('website.message.password')}}
            </x-ui.alert>
        </div>
    </div>
    <div class="col-12">
        <x-website.widgets.privacy-message/>
    </div>
    <div class="col-12 mt-3 d-grid gap-2 d-sm-flex justify-content-sm-end">
        <button type="submit" class="btn btn-success">
            {{ trans('message.register') }}
        </button>
    </div>
</form>
