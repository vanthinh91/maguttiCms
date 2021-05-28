@if (session('success'))
	<x-ui.alert class="alert-success alert-dismissible d-flex align-items-center" >
		{{icon('check-circle', 'fa-2x flex-shrink-0 me-2')}}
		<div>{!! session('success') !!}</div>
	</x-ui.alert>
@endif
@if ($errors->any())
	<x-ui.alert  class='alert-danger alert-dismissible d-flex align-items-center'>
		{{icon('times-circle', 'fa-2x flex-shrink-0 me-2')}}
		<div>
		@foreach ( $errors->all() as $error)
			<p>{{ $error }}</p>
		@endforeach
		</div>
	</x-ui.alert>
@endif
@if (session('error'))
	<x-ui.alert  class='alert-danger alert-dismissible d-flex align-items-center'>
		{{icon('times-circle', 'fa-2x flex-shrink-0 me-2')}}
		<p>{!! session('error') !!}</p>
    </x-ui.alert>

@endif
@if (session('warning'))
	<x-ui.alert  class='alert-warning alert-dismissible d-flex align-items-center'>
		{{icon('times-circle', 'fa-2x flex-shrink-0 me-2')}}
		<p>{!! session('warning') !!}</p>
	</x-ui.alert>
@endif
@if (session('status'))
	<x-ui.alert  class='alert-info alert-dismissible d-flex align-items-center'>
		{{icon('times-circle', 'fa-2x flex-shrink-0 me-2')}}
		<p>{!! session('status') !!}</p>
	</x-ui.alert>
@endif
