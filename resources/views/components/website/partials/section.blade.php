@props([
'caption',
'title'
])
<section {{ $attributes->merge(['class' => '']) }}>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                @if(isset($caption))
                    <h5 {{ $caption->attributes->merge(['class'=>'']) }}>{{$caption}}</h5>
                @endif
                @if(isset($title))
                    <h1 {{ $title->attributes->class([]) }}>{{$title}}</h1>
                @endif
                {{$slot}}
            </div>
        </div>
    </div>
</section>