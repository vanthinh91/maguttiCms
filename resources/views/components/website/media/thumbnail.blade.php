
@if($hasImageGallery())
    <div {{ $attributes->merge(['class' => 'container']) }}>
        <div class="row">
           {!! $title !!}
            <!-- Gallery -->
            @foreach ( $gallery()  as  $index => $item )
                <div class="col-lg-4 col-md-12 mb-4 ">
                    <div class="page-gallery-item" >
                        <img src="{{ ImgHelper::get_cached($item->file_name, ['w' => 600, 'h' => 400, 'q' => 70]) }}"
                             alt="{{$item->alt}}" class=" page-gallery-image w-100 shadow-1-strong ">
                        <div class="page-gallery-body bg-color-5 p-2">
                            <h6 class="page-gallery-title text-color-6 text-start">Card title</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif