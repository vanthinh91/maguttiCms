@if (session('success'))
	<div class="text-center alert alert-success alert-dismissible">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		{{icon('check-circle', 'fa-3x')}}
		<p>{!! session('success') !!}</p>
	</div>
@endif
@if ($errors->any())
	<div class='text-center alert alert-danger alert-dismissible'>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		{{icon('times-circle', 'fa-3x')}}
		@foreach ( $errors->all() as $error)
			<p>{{ $error }}</p>
		@endforeach
	</div>
@endif
@if (session('error'))
	<div class="text-center alert alert-danger alert-dismissible">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		{{icon('times-circle', 'fa-3x')}}
		<p>{!! session('error') !!}</p>
	</div>
@endif
@if (session('warning'))
	<div class="text-center alert alert-warning alert-dismissible">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		{{icon('exclamation-triangle', 'fa-3x')}}
		<p>{!! session('warning') !!}</p>
	</div>
@endif
@if (session('status'))
	<div class="text-center alert alert-info alert-dismissible">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		{{icon('exclamation-circle', 'fa-3x')}}
		<p>{!! session('status') !!}</p>
	</div>
@endif
