<section {{ $attributes->merge(['class' => 'page-child']) }}>
    <div class="container">
        @foreach($children as $child)
            <div id="{{$child->slug}}" class="row  {{ ($loop->last) ?'':' pb-2 mb-2' }}">
                <a name="#{{$child->slug}}"></a>
                <div class=" col col-12 col-lg-7 mb-2 mb-lg-0  {{$loop->even ? 'order-lg-1' :'order-lg-12' }}">
                    <x-website.partials.page-media-block :item="$child"/>
                </div>
                <div class="col  col-12 col-lg-5  {{$loop->even ? 'order-lg-12' :'order-lg-1' }} text-primary">
                    @if($child->subtitle!='')
                        <h6 class="text-accent ">{!! $child->subtitle !!}</h6>
                    @endif
                    <h2 class="text-primary text-uppercase ">{!! $child->title !!}</h2>
                    <div class="text-justify">{!! $child->description !!}</div>
                    @if($child->doc)
                        <a target="_new" class="download" href="{{ma_get_doc_from_repository($child->doc)}}">
                            <img src="{{asset(config('maguttiCms.admin.path.public').'/website/images/download_pdf.png')}}"
                                 class="img-responsive-100 download-icon" alt="{{ trans("website.download")  }}">
                            {!! trans("website.download") !!}
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
