<section {{ $attributes->merge(['class' => '']) }}>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center mb-2">
                <h2 class="text-color-4">{!! $item->title !!}</h2>
                <h4 class="text-primary">{!! $item->subtitle !!}</h4>
            </div>
        </div><!-- /row -->
        <div class="row py-2">
            <div class="col-12">
                <div class="swiper-container product-carousel">
                    <div class="swiper-wrapper">
                        @foreach (  $carousel_items()  as  $index => $carousel_item )
                            <x-website.carousels.product-carousel-item :item="$carousel_item" class="swiper-slide-product"></x-website.carousels.product-carousel-item>
                        @endforeach

                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination product-carousel-swiper-pagination"></div>
                </div>
            </div>

            <!--Grid column-->
        </div>
        <div class="row text-center mt-2 mt-sm-3">
            <div class="col">
                <x-website.ui.button :item="$item" :label="trans('website.see_all')"
                                     class="{{$buttonClass ?? 'btn-primary m-auto' }}"/>
            </div>
        </div>
        <!--Grid row-->
    </div>
</section>
@once
    @push('scripts')
        <script type="text/javascript">
            let productCarousel = new Swiper('.product-carousel', {
                // Optional parameters
                loop: true,
                slidesPerView: 1,
                spaceBetween: 10,
                slidesPerGroup: 1,
                // If we need pagination
                pagination: {
                    el: '.product-carousel-swiper-pagination',
                    clickable:true
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                        slidesPerGroup: 1,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 40,
                        slidesPerGroup: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 50,
                        slidesPerGroup: 3,
                    },
                },
                // Navigation arrows
            });
        </script>
    @endpush
@endonce




