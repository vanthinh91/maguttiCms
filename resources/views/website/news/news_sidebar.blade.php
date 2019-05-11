@inject('posts','App\News')

<aside class="mt-5 mt-md-0">
	<h5 class="text-muted">Latest news</h5>

	@foreach ($posts->LatestPublished(6)->get() as $latest_post)
	<div class="row">
		<div class="col-4 col-sm-4">
			<a href="{{ $latest_post->getPermalink() }}">
				<img class="img-responsive" src="{{ ImgHelper::get($latest_post->image,config('maguttiCms.image.small')) }}">
			</a>
		</div>
		<div class="col-8 col-sm-8">
			<a class="d-block" href="{{ $latest_post->getPermalink() }}">{{ $latest_post->title }}</a>
			<small>
				<i class="fa fa-clock mr-1"></i>
				{{ $latest_post->getFormattedDate() }}
			</small>
		</div>
	</div>
	@endforeach
</aside>
