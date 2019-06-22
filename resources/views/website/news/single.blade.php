@extends('website.app')
@section('content')

    <main class="my-5">
		<div class="container">
            <div class="row">
                <div class="col-12 col-md-9">
                    <article>
                        <h1 class="text-primary mb-3">{{ $news->title }}</h1>
                        <h5 class="text-muted mb-4">
                            <i class="fa fa-clock mr-1"></i>
                            {{ $news->date }}
                        </h5>

                        @if($news->image)
                        <img src="{{ ImgHelper::get_cached($news->image, config('maguttiCms.image.medium')) }}" alt="{{ $news->title }}" class="img-fluid mb-4">
                        @endif

                        {!! $news->description !!}
                    </article>

                    @include('website.news.news_share')
                </div>

                <div class="col-12 col-md-3">
                    @include('website.news.news_sidebar')
                </div>
            </div>
		</div>
	</main>

@endsection
