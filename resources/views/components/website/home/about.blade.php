@props([
    'class'
])
<x-website.partials.section  class="{{$class}}">
    <x-slot name="caption" class="text-accent">{{$item->subtitle}}</x-slot>
    <x-slot name="title" class="h1 text-primary">{{$item->title}}</x-slot>
    <div class="px-lg-15 mb-3 text-justify">{!!  $item->description !!}</div>
    <x-website.ui.button  :item="$item" class="btn-outline-primary" />
</x-website.partials.section>

