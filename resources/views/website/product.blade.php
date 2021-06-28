@extends('website.app')
@section('content')
	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb d-flex align-items-end">
			<div class="page-breadcrumb__item"><a href="{{$product->category->getPermalink()}}">{{$product->category->title}}</a></div>
			<div class="page-breadcrumb__item">{{$product->title}}</div>
		</div>
	</x-website.ui.breadcrumbs>
	<x-magutti_store-shop-banner-component/>
	<section class="product-page">
		<div class="container">
			<div class="row no-gutters">
				<div class="col-12 col-sm-6 order-md-1 my-2 my-md-0 product-page-image p-0 m-0">


					<img class="img-fluid" src="{{ ImgHelper::init('products')->get_cached($product->image, config('maguttiCms.image.large')) }}" alt="{{ $product->title }}">

				    @if($product->on_sale)
						<div class="products__card-on-sale">ON SALE</div>
					@endif
				</div>
				<div class="col-12 col-sm-6 order-md-2">
					<div class="product-page-card">
						<h1 class="text-primary product-page-title">{{ $product->title }}</h1>
						<h5 class="text-color-4 product-page-code">{{ trans('store.product.sku') }}: {{ $product->code }}</h5>
						<div class="product-page-description">{!! $product->description !!}</div>
						@if (StoreHelper::isStoreEnabled())
							<div class="h4 product-page-price my-3">
							<x-magutti_store-product-display-price
									:product="$product"
									:type="'product-page'"/>
							</div>
							<cart-add-item
									ref="v100"
									:product="{{$product}}" :min=1 :step="1" :max="100" :value=1>
								<template #btn_label>{{ trans('store.items.add') }}</template>
								<template #label><h5
											class="product-page-add-label text-italic text-color-4 mb-1">{{ trans('store.cart.table.quantity') }}</h5>
								</template>
							</cart-add-item>
						@endif
					</div>

				</div>
			</div>
		</div>
	</section>

@endsection
