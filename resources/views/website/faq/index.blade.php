@extends('website.app')
@section('content')
    <x-website.ui.breadcrumbs class="bg-dark">
        <div class="text-white page-breadcrumb d-flex align-items-end">
            @if($article->parent)
                <div class="page-breadcrumb__item">{{$article->parent->title}}</div>
            @endif
            <div class="page-breadcrumb__item">{{$article->menu_title}}</div>
        </div>
    </x-website.ui.breadcrumbs>
    <x-website.ui.banner class="bg-accent py-5" :item="$article"></x-website.ui.banner>
    <x-website.partials.section class="py-1">
        <x-website.ui.accordion :items="$faqs"/>
    </x-website.partials.section>
@endsection
