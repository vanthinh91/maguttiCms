@extends('website.app')
@section('content')

	<main class="my-5">
        <div class="container">
			<div class="row">
				<div class="col-12 col-lg-5 mx-auto">
					<h1 class="text-primary text-center">{{ $article->title }}</h1>

					@include('website.auth.form.login')
				</div>
			</div>
		</div>
	</main>

@endsection
