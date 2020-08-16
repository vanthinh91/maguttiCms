@extends('website.app')
@section('content')
	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb d-flex align-items-end">
			@if($article->parent)
				<div class="page-breadcrumb-item">{{$article->parent->title}}</div>
			@endif
			<div class="page-breadcrumb-item">{{$article->menu_title}}</div>
		</div>
	</x-website.ui.breadcrumbs>
	<main class="my-2">
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
