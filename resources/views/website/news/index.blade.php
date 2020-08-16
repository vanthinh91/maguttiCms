@extends('website.app')
@section('content')
	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb d-flex align-items-end">
			<div class="page-breadcrumb-item">{{$article->title}}</div>
		</div>
	</x-website.ui.breadcrumbs>
	<main class="my-2">
		<div class="container">


			<div class="row">

				@foreach ($news as $post)
				<div class="col-12 col-sm-6 col-lg-4 mb-4">
					<article class="card box-shadow">
						<img class="card-img-top" src="{{ ImgHelper::get($post->image, config('maguttiCms.image.defaults')) }}" alt="{{ $post->title }}">
						<div class="card-body">
							<h5 class="card-title">{{ $post->title }}</h5>
							<div class="card-text">{{ $post->getExcerpt() }}</div>

							<a href="{{ $post->getPermalink() }}" class="btn btn-primary mt-3">
								{{ trans('website.read_more') }}
								{{ icon('fas fa-caret-right') }}
							</a>
						</div>
						<div class="card-footer">
							<small class="text-muted">
								<i class="fa fa-clock mr-1"></i>
								{{ Carbon::parse($post->date)->format('d/m/Y') }}
							</small>
						</div>
					</article>
				</div>
				@endforeach
			</div>

			{{ $news->links() }}
		</div>
	</main>

@endsection
