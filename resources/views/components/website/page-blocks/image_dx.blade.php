@props([
    'type'=>'blocks',
    'button_color'=>'btn-outline-color-4',
])

<div class="row blocks-item">
    <div class="col-lg-6 {{$type}}-content justify-content-end">
        <x-website.page-blocks.content :block="$block" :buttonColor="$button_color" />
    </div>
    <div class="col-lg-6 blocks-image ">
        @if($block->video)
            <x-media.video :video="$block->video" :classExtra="'mb-2'"></x-media.video>
        @else
            <x-website.page-blocks.image :block="$block" type="blocks" />
        @endif
    </div>
</div>