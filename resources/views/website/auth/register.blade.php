@extends('website.app')
@section('content')
	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb d-flex align-items-end">
			<div class="page-breadcrumb__item">{{ trans('message.register') }}</div>
		</div>
	</x-website.ui.breadcrumbs>
	<section>
        <div class="container">
			<div class="row">
				<div class="col-12 col-lg-6 mx-auto auth-box">
					<h2 class="text-primary text-center auth-box-title">{{ trans('message.register_account') }}</h2>
					<div class="auth-box-content">
					@include('website.auth.form.register')
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
