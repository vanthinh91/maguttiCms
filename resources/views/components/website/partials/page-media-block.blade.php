
@if($item->video)
    <x-media.video :video="$item->video"/>
@elseif($item->hasGallery())
    <div class="gallery-owl owl-carousel owl-theme-inside">
        @foreach($item->gallery()->orderBy('sort')->get() as $slider)
            <div class="item" style="z-index: 1">
                <img src="{!! ImgHelper::get_cached($slider->file_name,config('maguttiCms.image.medium')) !!}"
                     alt="{!! $slider->file_name  !!}"
                     border="0">
            </div>
        @endforeach
    </div>
@else
    <img src="{!! ImgHelper::get_cached($item->image, config('maguttiCms.image.medium')) !!}"
         alt="{{ $item->title }}" border="0" class="img-fluid w-100">
@endif


@once
    @push('scripts')
    <script type="text/javascript">
        var galleryOwl = $('.gallery-owl');
        galleryOwl.owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                800: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            },
        });

        $('.customNextBtnPercorsi').click(function () {
            galleryOwl.trigger('next.owl.carousel');
        })
        // Go to the previous item
        $('.customPrevBtnPercorsi').click(function () {
            galleryOwl.trigger('prev.owl.carousel', [300]);
        })
    </script>
    @endpush
@endonce