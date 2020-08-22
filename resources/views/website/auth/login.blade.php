@extends('website.app')
@section('content')
	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb d-flex align-items-end">
			@if($article->parent)
				<div class="page-breadcrumb__item">{{$article->parent->title}}</div>
			@endif
			<div class="page-breadcrumb__item">{{$article->menu_title}}</div>
		</div>
	</x-website.ui.breadcrumbs>
	<section>
        <div class="container">
			<div class="row">
				<div class="col-12 col-lg-5 mx-auto login-box">
					<h2 class="login-box-title text-primary text-center">{{ $article->title }}</h2>
					<div class="login-box-content">
						@include('website.auth.form.login')
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
