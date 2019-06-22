@extends('website.app')
@section('content')

	<main class="my-5">
        <div class="container">
			<div class="row">
				<div class="col-12 col-lg-5 mx-auto">
					<h1 class="text-primary text-center">{{ trans('message.password_reset') }}</h1>
					<div class="alert alert-info">
						{{trans('website.message.password')}}
					</div>

					@include('website.auth.form.reset')
				</div>
			</div>
		</div>
	</main>

@endsection
