@extends('website.app')
@section('content')

    <x-website.partials.page-content :article="$article"></x-website.partials.page-content>
    <x-website.page-blocks.lists :item="$article"/>
    <x-website.partials.section  class="pt-0 pb-2">
        <x-website.widgets.sharer :item="$article" class="text-start"/>
    </x-website.partials.section>
@endsection
