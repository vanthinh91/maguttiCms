<article class="news__single me-md-2 mb-2">
    <h5 class="text-muted mb-1">
        <i class="fa fa-clock me-1"></i>{{ $news->getFormattedDate() }}
    </h5>
    <h1 class="text-primary mb-2">{{ $news->title }}</h1>
    @if($news->video)
        <x-media.video :video="$news->video" :classExtra="'mb-2'"></x-media.video>
    @elseif($news->hasImageMedia())
        <img src="{{ ImgHelper::get_cached(optional($latest_post->imageMedia)->file_name,config('maguttiCms.image.medium')) }}" alt="{{ $news->title }}" class="img-fluid mb-2">
    @else
        <img src="https://picsum.photos/seed/picsum/1200/900" alt="{{ $news->title }}" class="img-fluid mb-2">
    @endif
    {!! $news->description !!}
    @if($news->hasBlocks())
        <div class="my-2">
            @foreach($news->blocks()->sorted()->get() as $block)
                <x-website.page-blocks.item :block="$block" type="blocks"/>
            @endforeach
        </div>
    @endif
    <x-website.partials.page-doc :doc="$news->doc" class="mb-3"/>
</article>
<x-website.widgets.tags :news="$news"/>
<x-website.widgets.sharer :item="$news"/>