
<form class="login-form row g-3" method="post" action="{{url_locale('users/login')}}">
	{!! csrf_field() !!}
	@if (isset($redirectTo))
		<input type="hidden" name="redirectTo" value="{{$redirectTo}}">
	@endif
	<div class="col-12">
		<x-website.ui.input type="email" for="email" placeholder="{{ trans('website.email') }}*" required />
	</div>
	<div class="col-12">
    	<x-website.ui.input type="password" for="password" value="" autocomplete="off" placeholder="{{trans('website.password')}}*" required/>
	</div>

	<div class="login-form-support d-flex flex-wrap justify-content-between">
		<x-website.ui.checkbox for="remember">
			{{ trans('message.remember_me') }}
		</x-website.ui.checkbox>
		<div>
			<a class="text-color-4" href="{{ url_locale('/password/reset') }}">
				{{ trans('message.password_forgot_your') }}
			</a>
		</div>
	</div>
	<div class="col">
		<button type="submit" class="btn btn-primary btn-block">
			{{ trans('message.sign_in') }}
		</button>
	</div>

	@if (!isset($with_register))
		<div class="login-form-not-registered d-flex justify-content-center">
			{{ trans('message.not_registered') }}
			<a class="ms-1 text-accent" href="{{ url_locale('/register') }}">{{ trans('message.new_user') }}
			</a>
		</div>
	@endif
</form>
