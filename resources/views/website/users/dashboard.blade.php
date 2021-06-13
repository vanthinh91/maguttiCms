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
	<main class="my-2">
        <div class="container">
			@if (StoreHelper::isStoreEnabled())
				<div class="my-0">
					<x-magutti_store-order-list-component/>
				</div>
				<div class="my-4 d-none">
					<h3 class="text-muted">{{ trans('store.dashboard.addresses') }}</h3>
					<ul>
						@foreach ($addresses as $_address)
							<li>{{$_address->display_inline}}</li>
						@endforeach
					</ul>
					<a class="btn btn-primary" href="{{url_locale('/users/address-new')}}">
						{{trans('store.address.new')}}
					</a>
				</div>
			@endif
        </div>
    </main>

@endsection
