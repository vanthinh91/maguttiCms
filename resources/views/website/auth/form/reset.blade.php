<form class="row d-grid gy-3" role="form" method="POST" action="{{url_locale('/password/reset')}}">
	{{ csrf_field() }}
	<x-website.ui.input type="hidden" for="token" value="{{ $token }}"/>
	<div class="col-12">
		<x-website.ui.input type="email" for="email"  autocomplete="off" placeholder="{{ trans('website.email') }}"/>
	</div>
	<div class="col-12">
		<x-website.ui.input type="password" for="password" placeholder="{{trans('website.password')}}"/>
	</div>
	<div class="col-12">
		<x-website.ui.input type="password" for="password_confirmation" placeholder="{{ trans('message.password_confirm') }}"/>
	</div>
	<div class="col-12">

		<div class="alert alert-color-4">
			{{trans('website.message.password')}}
		</div>
	</div>
	<div class="col-12 d-grid gap-2 d-sm-flex justify-content-sm-end">
		<button type="submit" class="btn btn-success">{{ trans('message.password_reset') }}</button>
	</div>
</form>
