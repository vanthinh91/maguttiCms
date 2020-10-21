<section {{ $attributes->merge(['class' => 'py-3']) }}>
    <div class="container">
        <div class="row">
            @if($article->image)
                <div class="col-12 col-md-6 order-md-2 mb-3 mb-md-0">
                    <img src="{{ ImgHelper::get_cached($article->image, config('maguttiCms.image.medium')) }}"
                         alt="{{ $article->title }}" class="img-fluid">
                </div>
            @endif
            <div class="col-12 col-md-6 order-md-1">
                @if($article->subtitle)
                    <h2 class="text-accent">{{ $article->subtitle }}</h2>
                @endif
                <h1 class="text-primary">{{ $article->title }}</h1>

                {!! HtmlHelper::content_part($article->description,1) !!}
                @foreach(HtmlHelper::content_part_looper($article->description) as $part)
                    {!! $part !!}
                @endforeach
            </div>
        </div>
    </div>
</section>
