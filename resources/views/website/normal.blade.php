@extends('website.app')
@section('content')
    <x-website.partials.page-content :article="$article"></x-website.partials.page-content>
    <x-website.page-blocks.lists :item="$article"/>
    <x-website.media.thumbnail :item="$article" class="page-thumb pt-5">
        <x-slot name="title"><h4 class="text-color-6">Thumbnail Title</h4></x-slot>
    </x-website.media.thumbnail>
    <x-website.partials.section  class="pt-0 pb-2">
        <x-website.widgets.sharer :item="$article" class="text-start"/>
    </x-website.partials.section>
@endsection
