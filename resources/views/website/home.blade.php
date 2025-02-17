@inject('pages','App\Article')
<?php $items = $pages::published()->get();?>
@extends('website.app')
@section('content')
   {{-- Header --}}
    <x-website.home.slider class="owl-theme"/>
    <x-website.partials.section class="bg-accent py-5">
        <x-slot name="caption"  class="text-primary">{{$article->subtitle}}</x-slot>
        <x-slot name="title"    class="h1 text-white">{{$article->title}}</x-slot>
        <div class="px-0 px-lg-4 text-justify text-white">{!!  $article->description !!}</div>
    </x-website.partials.section>
    <x-website.carousels.product-carousel :item="$items->find(13)" class="bg-color-5"/>
    <x-website.partials.page-block
            :item="$article->blockById(2)"
            class="bg-color-4 tags"
            classCaption="text-accent"
            color="text-white"
            buttonClass="btn-outline-accent"
    >
    </x-website.partials.page-block>
    <x-website.home.about :item="$items->find(2)" class="bg-white home_about"/>
    <x-website.partials.section :class="'bg-color-5 py-5'">
        <x-slot name="title" class="h1 text-accent">Metrics</x-slot>
        <x-website.widgets.metrics />
    </x-website.partials.section>

@endsection
