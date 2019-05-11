@extends('website.app')
@section('content')

	<main class="my-5">
        <div class="container">
			<div class="row">
				<div class="col-xs-12 col-lg-5 mx-auto">
					<h1 class="text-primary text-center">{{ trans('message.password_forgot') }}</h1>

					@include('website.auth.form.password')
				</div>
			</div>
		</div>
	</main>

@endsection
