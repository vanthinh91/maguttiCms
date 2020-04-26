@extends('website.app')
@section('content')

	<main class="my-5">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-4 order-md-2 mb-3 mb-md-0">
					<img class="img-fluid" src="{{ ImgHelper::get_cached($product->image, config('maguttiCms.image.medium')) }}" alt="{{ $product->title }}">
				</div>

				<div class="col-12 col-sm-8 order-md-1">
					<h1 class="text-primary">{{ $product->title }}</h1>
					<h5 class="text-muted">{{ trans('store.product.code') }}: {{ $product->code }}</h5>

					{!! $product->description !!}

					@if (StoreHelper::isStoreEnabled())
						{{ trans('store.product.price') }}: {{ StoreHelper::formatProductPrice($product) }}
						<hr>



						<cart-add-item
								ref="v100"
								:product="{{$product}}" :min="-20" :step="1"  :max="100" :value=1>
							<template #label>{{ trans('store.items.add') }}</template>
						</cart-add-item>

						<button onclick="app.$refs.v100.update(3.3)" class="d-none">add</button>

					@endif

				</div>
			</div>
		</div>
	</main>

@endsection
