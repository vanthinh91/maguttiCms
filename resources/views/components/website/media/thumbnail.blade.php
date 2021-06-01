
@if($hasImageGallery())
   <section {{ $attributes->merge(['class' => '']) }}>
       <div class="container">
           <div class="row">
           {!! $title ??'' !!}
           <!-- Gallery -->
               @foreach ( $gallery()  as  $index => $item )
                   <div class="col-lg-4 col-md-12 mb-4 ">
                       <div class="thumbnail-item" >
                           <img src="{{ ImgHelper::get_cached($item->file_name, ['w' => 600, 'h' => 400, 'q' => 70]) }}"
                                alt="{{$item->alt}}" class="thumbnail-image ">
                           <div class="thumbnail-caption">
                               <h6 class="thumbnail-caption-title text-start">{{$item->title}}</h6>
                           </div>
                       </div>
                   </div>
               @endforeach
           </div>
       </div>
   </section>

@endif