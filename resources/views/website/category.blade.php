@extends('website.app')
@section('content')
	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb d-flex align-items-end">
			<div class="page-breadcrumb-item">{{$category->title}}</div>
		</div>
	</x-website.ui.breadcrumbs>
	<main class="my-2">
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
