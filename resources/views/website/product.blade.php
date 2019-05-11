@extends('website.app')
@section('content')

	<main class="my-5">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4 order-md-2 mb-3 mb-md-0">
					<img class="img-fluid" src="{{ ImgHelper::get_cached($product->image, config('maguttiCms.image.medium')) }}" alt="{{ $product->title }}">
				</div>

				<div class="col-xs-12 col-sm-8 order-md-1">
					<h1 class="text-primary">{{ $product->title }}</h1>
					<h5 class="text-muted">{{ trans('store.product.code') }}: {{ $product->code }}</h5>

					{!! $product->description !!}

					@if (StoreHelper::isStoreEnabled())
						{{ trans('store.product.price') }}: {{ StoreHelper::formatProductPrice($product) }}
						<hr>

						<div class="form-inline">
							<input class="form-control cart-item-quantity mr-2 my-1" type="number" name="quantity" value="1" min="1" autocomplete="off">

							<a href="#" class="btn btn-primary cart-item-add my-1" data-product-code="{{$product->code}}" data-quantity="1">
								{{ trans('store.items.add') }}
							</a>
						</div>
					@endif

				</div>
			</div>
		</div>
	</main>

@endsection
