<form method="post" action="{{url_locale('users/change-password')}}">
    @csrf
    <div class="row gy-3">
        <div class="col-12">

            <label for="password">{{ trans('website.current_password') }}</label>
            <input type="password"
                   autocomplete="new-password"
                   class="form-control" name="current_password"
                   placeholder="{{ trans('website.current_password') }}"
            >
            <x-website.ui.form-error-label field="current_password"/>
        </div>
        <div class="col-12">
            <label for="password">{{ trans('website.password') }}</label>
            <input type="password"
                   autocomplete="new-password"
                   class="form-control" name="password"
                   placeholder="{{ trans('website.password') }}"
            >
            <x-website.ui.form-error-label field="password"/>
        </div>
        <div class="col-12">
            <label for="password_confirmation">{{ trans('message.password_confirm') }}</label>
            <input type="password" class="form-control" name="password_confirmation"
                   placeholder="{{ trans('message.password_confirm') }}">
            <x-website.ui.form-error-label field="password_confirmation"/>
        </div>

        <div class="col-12">
            <div class="mt-2 d-flex justify-content-end">
                <x-website.users.action-button>
                    {{ trans('website.save') }}
                </x-website.users.action-button>
            </div>
        </div>
    </div>
</form>
