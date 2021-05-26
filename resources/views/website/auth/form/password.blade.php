@if (session('status'))
	<div class="text-center alert alert-info">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">{{icon('times')}}</button>
		{{icon('exclamation-circle', 'fa-3x')}}
		<p>{!! session('status') !!}</p>
	</div>
@endif
<form method="POST" action="{{ url_locale('/password/email') }} " class="row gy-4">
	{{ csrf_field() }}
	<div class="col-12">
		<x-website.ui.input type="email" placeholder="{{ trans('website.email') }}" for="email" />
	</div>
	<div class="col-12 d-flex justify-content-end ">
		<button type="submit" class="btn btn-primary">
			{{ trans('message.password_sent_reset_link') }}
		</button>
	</div>
</form>