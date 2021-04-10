@props([
'type'=>'blocks',
'button_color'=>'btn-outline-color-4',
])
<div class=" row blocks-item">
    <div class="col-lg-12 {{$type}}-content">
        <x-website.page-blocks.content :block="$block" :buttonColor="$button_color" />
    </div>
</div>