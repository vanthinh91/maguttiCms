@props([
    'type'=>'blocks',
    'button_color'=>'btn-outline-color-4',
])
<div class="row blocks-item ">
    <div class="col-lg-6 d-flex justify-content-end blocks-image">
        @if($block->video)
        <x-media.video :video="$block->video" :classExtra="'mb-2'"></x-media.video>
        @else
        <x-website.page-blocks.image :block="$block" type="blocks" />
        @endif
    </div>
    <div class="col-lg-6 {{$type}}-content">
        <x-website.page-blocks.content :block="$block" :buttonColor="$button_color" />
    </div>
</div>
