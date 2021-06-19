<article class="card box-shadow products__card mb-3">
    <img class="card-img-top" src="{{ ImgHelper::get($product->image, config('maguttiCms.image.defaults'),'products') }}" alt="{{ $product->title }}">
    <div class="card-body bg-color-3">
        <h4 class="card-title text-primary"><span class="text-uppercase">{{ $product->title }}</span> <span class="card-code text-muted"> - {{ trans('store.product.sku') }}: {{ $product->code }}</span> </h4>
        <div class="card-price">
            <x-magutti_store-product-display-price
                    :product="$product"
                    :type="'card'"/>
        </div>
        <a href="{{ $product->getPermalink() }}" class="btn btn-sm btn-outline-accent mt-2 stretched-link">
            {{ trans('website.see') }} {{ icon('fas fa-caret-right') }}
        </a>
    </div>
    @if($product->on_sale)
    <div class="products__card-on-sale">ON SALE</div>
    @endif
</article>
