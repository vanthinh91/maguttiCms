@extends('website.app')
@section('content')

	<main class="my-5">
		<div class="container">
			<h1 class="text-primary">{{ $category->title }}</h1>

			<ul>
				@foreach ($products as $product)
					<li><a href="{{ $product->getPermalink() }}">{{ $product->title }}</a></li>
				@endforeach
			</ul>
		</div>
	</main>

@endsection
