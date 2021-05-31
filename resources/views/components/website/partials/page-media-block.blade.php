@if($item->video)
    <x-media.video :video="$item->video"/>
@elseif($item->hasGallery())
    <x-website.media.media-carousel :item="$item" class="border border-light bg-light pb-3" >
    </x-website.media.media-carousel>
@else
    <img src="{!! ImgHelper::get_cached($item->image, config('maguttiCms.image.medium')) !!}"
         alt="{{ $item->title }}" border="0" class="img-fluid w-100">
@endif
