@extends('website.app')
@section('content')

    <main class="my-5">
        <div class="container">
            <h1 class="text-primary">{{trans('store.order.guard')}}</h1>

            <hr>
        	<div class="row">
        		<div class="col-12 col-sm-6">
        			<h3>{{trans('store.order.login')}}</h3>
        			@include('website.auth.form.login')
        		</div>
        		<div class="col-12">
        			<hr>
        		</div>
        		<div class="col-12 col-sm-6">
        			<h3>{{trans('store.order.register')}}</h3>
        			@include('website.auth.form.register')
        		</div>
        	</div>
        </div>
    </main>

@endsection
