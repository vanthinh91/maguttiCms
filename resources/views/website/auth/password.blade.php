@extends('website.app')
@section('content')
	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb d-flex align-items-end">
			<div class="page-breadcrumb__item">{{ trans('message.password_forgot') }}</div>
		</div>
	</x-website.ui.breadcrumbs>
	<section>
        <div class="container">
			<div class="row">
				<div class="col-12 col-lg-5 mx-auto auth-box">
					<div class="auth-box-content">
						<h2 class="text-primary text-center mb-3">{{ trans('message.password_forgot') }}</h2>
						@include('website.auth.form.password')
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
