@extends('website.app')
@section('content')
	<main class="my-5">
        <div class="container">
            <h1 class="text-primary">{{ $article->title }}</h1>
			@include('website.product.product_list')
		</div>
	</main>
@endsection
