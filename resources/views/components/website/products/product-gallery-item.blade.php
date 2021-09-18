<div {{ $attributes->merge(['class' => 'swiper-slide'])}}>
    <img src="{{ ImgHelper::init($attributes['disk'])->get_cached($image, config('maguttiCms.image.large')) }}"
        alt="" class="img-fluid w-100">
</div>