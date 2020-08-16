@extends('website.app')
@section('content')
	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb d-flex align-items-end">
			<div class="page-breadcrumb-item">{{trans('store.order.guard')}}</div>
		</div>
	</x-website.ui.breadcrumbs>
    <main class="my-2">
        <div class="container">
            <h1 class="text-primary">{{trans('store.order.guard')}}</h1>
            <hr>
        	<div class="row">
        		<div class="col-12 col-sm-6">
					<h3>{{trans('store.order.register')}}</h3>
					@include('website.auth.form.register')
				</div>
				<div class="col-12 col-sm-6">
					<h3>{{trans('store.order.login')}}</h3>
					@include('website.auth.form.login')
				</div>
			</div>
        </div>
    </main>

@endsection
