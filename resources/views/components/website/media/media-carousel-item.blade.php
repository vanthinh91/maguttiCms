<div {{ $attributes->merge(['class' => 'swiper-slide'])}}>
    <img src="{{ ImgHelper::init('')->get_cached($image, ['w' => 600, 'h' => 400, 'q' => 70]) }}"
         alt="" class="img-fluid w-100">
</div>