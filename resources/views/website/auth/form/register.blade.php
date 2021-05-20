<form method="post" action="{{url_locale('register')}}">
    @csrf
    @if (isset($redirectTo))
        <input type="hidden" name="redirectTo" value="{{$redirectTo}}">
    @endif
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="{{ trans('website.firstname') }}" name="firstname"
                       value="{{ old('firstname') }}" required>
                <x-website.ui.form-error-label  field="firstname"/>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="{{ trans('website.lastname') }}" name="lastname"
                       value="{{ old('lastname') }}" required>
                <x-website.ui.form-error-label  field="lastname"/>
            </div>
        </div>
        <div class="col-12">
        <div class="form-group">
            <input type="email" class="form-control" placeholder="{{ trans('website.email') }}" name="email"
                   value="{{ old('email') }}" required>
            <x-website.ui.form-error-label  field="email"/>
        </div>
        </div>
        <div class="col-12">
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="{{ trans('website.password') }}"
                   required>
            <x-website.ui.form-error-label  field="password"/>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password_confirmation"
                   placeholder="{{ trans('message.password_confirm') }}" required>

            <div class="mt-2 alert alert-color-4">
                {{trans('website.message.password')}}
            </div>
        </div>
        </div>
        <div class="col-12">
        <div class="form-group">
            <div class="form-checkbox">
                <input type="checkbox" class="form-input" name="privacy" value="1" id="privacy" required>
                <label for="privacy">
                    <a href="https://www.iubenda.com/privacy-policy/{{ data_get($site_settings,'iubenda_code_'.LaravelLocalization::getCurrentLocale()) }}"
                       class="iubenda-nostyle no-brand iubenda-embed " title="{{ trans('website.privacy')}}">
                        {{trans('website.message.privacy')}}
                    </a>
                </label>
                {{ $errors->first('privacy') }}
            </div>
        </div>
        <div class="">
            <button type="submit" class="btn btn-primary btn-block">
                {{ trans('message.register') }}
            </button>
        </div>
        </div>
    </div>
</form>
