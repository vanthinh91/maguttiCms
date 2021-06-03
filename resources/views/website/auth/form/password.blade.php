@if ($errors->any())
	<x-ui.alert class="text-center alert-color-4 d-flex align-items-center" >
		{{icon('exclamation-circle', 'fa-2x flex-shrink-0 me-2')}}
		<div>
			@foreach ( $errors->all() as $error)
				<div>{{ $error }}</div>
			@endforeach
		</div>
	</x-ui.alert>
@endif

@if(session('status'))
<x-ui.alert class="text-center alert-color-4 d-flex align-items-center" >
	{{icon('exclamation-circle', 'fa-2x flex-shrink-0 me-2')}}
	<div>{!! session('status') !!}</div>
</x-ui.alert>
@endif

<form method="POST" action="{{ url_locale('/password/email') }} " class="row gy-4">
	{{ csrf_field() }}
	<div class="col-12">
		<x-website.ui.input type="email" placeholder="{{ trans('website.email') }}" enableError="{{false}}" for="email" />
	</div>
	<div class="col-12 d-flex justify-content-end ">
		<button type="submit" class="btn btn-primary">
			{{ trans('message.password_sent_reset_link') }}
		</button>
	</div>
</form>