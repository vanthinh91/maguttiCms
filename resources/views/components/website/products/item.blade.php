<article class="card box-shadow products__card">
    <img class="card-img-top" src="{{ ImgHelper::get($product->image, config('maguttiCms.image.defaults')) }}" alt="{{ $product->title }}">
    <div class="card-body bg-color-3">
        <div class="card-price">{{ StoreHelper::formatProductPrice($product) }}</div>
        <h4 class="card-title text-primary">{{ $product->title }} <span class="card-code text-muted"> - {{ trans('store.product.code') }}: {{ $product->code }}</span> </h4>
        <a href="{{ $product->getPermalink() }}" class="btn btn-sm btn-outline-accent mt-2">
            {{ trans('website.see') }} {{ icon('fas fa-caret-right') }}
        </a>
    </div>
</article>
