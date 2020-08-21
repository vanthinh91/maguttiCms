@extends('website.app')
@section('content')
	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb d-flex align-items-end">
			<div class="page-breadcrumb__item">{{ trans('message.password_forgot') }}</div>
		</div>
	</x-website.ui.breadcrumbs>
	<section class="my-2">
        <div class="container">
			<div class="row">
				<div class="col-12 col-lg-5 mx-auto">
					<h2 class="text-primary text-center">{{ trans('message.password_forgot') }}</h2>
					@include('website.auth.form.password')
				</div>
			</div>
		</div>
	</section>

@endsection
