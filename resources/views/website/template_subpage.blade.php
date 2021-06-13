@inject('pages','App\Article')
<?php $items = $pages::published()->get();?>
@extends('website.app')
@section('content')
    <x-website.ui.breadcrumbs class="bg-accent">
        <div class="text-white page-breadcrumb d-flex align-items-end">
            @if($article->parent)
                <div class="page-breadcrumb__item">{{$article->parent->title}}</div>
            @endif
            <div class="page-breadcrumb__item">{{$article->menu_title}}</div>
        </div>
    </x-website.ui.breadcrumbs>
    <x-website.partials.page-content-full-image :article="$article"/>
    <x-website.partials.page-child :children="$article->children" class="mt-0 pt-1 pb-1"/>
    <x-website.page-blocks.lists :item="$article"/>
    <x-website.partials.section  class="pt-0 pb-2">
        <x-website.widgets.sharer :item="$article" class="text-start"/>
    </x-website.partials.section>
@endsection
