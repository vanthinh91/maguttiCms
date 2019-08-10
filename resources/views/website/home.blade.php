@inject('hpslider','App\HpSlider')
@extends('website.app')
@section('content')

    {{-- Header --}}
    <header id="carousel" class="slider owl-carousel">
    	@foreach ($hpslider->active()->get() as $index => $slider)
            <div class="item">
    			<img src="{{ ImgHelper::get_cached($slider->image, ['w' => 1920, 'h' => 600, 'c' => 'cover', 'q' => 70]) }}" alt="" class="img-fluid">

                <div class="slider-text">
    				<div class="container">
    					<h2 class="text-primary">{{ $slider->title }}</h2>
    	                <div class="lead">{{ $slider->description }}</div>
    				</div>
                </div>
            </div>
        @endforeach
    </header>

    {{-- Description --}}
    <section class="my-5">
        <div class="container">
            <h1 class="text-primary">{{ $article->title }}</h1>

            @if($article->subtitle)
            <h2>{{ $article->subtitle }}</h2>
            @endif

            @if($article->description)
            <div class="lead mt-3">
                {!! $article->description !!}
            </div>
            @endif

            @if($article->image)
            <img src="{{ ma_get_image_from_repository($article->image) }}" alt="" class="img-fluid">
            @endif
			<div class="">
				<a href="#" class="btn btn-lg">Custom button</a>
				<a href="#" class="btn btn-lg btn-primary">Custom button</a>
				<a href="#" class="btn btn-lg btn-secondary">Custom button</a>
				<a href="#" class="btn btn-lg btn-accent">Custom button</a>
				<a href="#" class="btn btn-lg btn-color-4">Custom button</a>
				<a href="#" class="btn btn-lg btn-color-5">Custom button</a>
			</div>
			<div class="">
				<a href="#" class="btn btn-lg btn-outline">Custom button</a>
				<a href="#" class="btn btn-lg btn-outline-primary">Custom button</a>
				<a href="#" class="btn btn-lg btn-outline-secondary">Custom button</a>
				<a href="#" class="btn btn-lg btn-outline-accent">Custom button</a>
				<a href="#" class="btn btn-lg btn-outline-color-4">Custom button</a>
				<a href="#" class="btn btn-lg btn-outline-color-5">Custom button</a>
			</div>
        </div>
    </section>

@endsection
@section('footerjs')
	<script type="text/javascript">
		$('#carousel').owlCarousel({
			items:1,
			loop:true,
			dots:true,
			nav:false
		});
	</script>
@endsection
