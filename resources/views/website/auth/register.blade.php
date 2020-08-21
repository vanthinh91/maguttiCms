@extends('website.app')
@section('content')
	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb d-flex align-items-end">
			<div class="page-breadcrumb__item">{{ trans('message.register') }}</div>
		</div>
	</x-website.ui.breadcrumbs>
	<section class="py-3">
        <div class="container">
			<div class="row">
				<div class="col-12 col-lg-5 mx-auto">
					<h3 class="text-primary text-center">{{ trans('message.register_account') }}</h3>
					@include('website.auth.form.register')
				</div>
			</div>
		</div>
	</section>

@endsection
