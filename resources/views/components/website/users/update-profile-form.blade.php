<form method="post" action="{{url_locale('/users/profile')}}">
    @csrf
    <div class="row ">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="firstname">{{ trans('website.firstname') }}*</label>
                <input type="text" class="form-control" placeholder="{{ trans('website.firstname') }}" name="firstname"
                       value="{{ $user->firstname }}" srequired>
                <x-website.ui.form-error-label field="firstname"/>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="lastname">{{ trans('website.lastname') }}*</label>
                <input type="text" class="form-control" placeholder="{{ trans('website.lastname') }}" name="lastname"
                       value="{{ $user->lastname }}" srequired>
                <x-website.ui.form-error-label field="lastname"/>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="email">{{ trans('website.email') }}*</label>
                <input type="email" class="form-control" placeholder="{{ trans('website.email') }}" name="email"
                       value="{{ $user->email }}" srequired>
                <x-website.ui.form-error-label field="email"/>

            </div>
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
