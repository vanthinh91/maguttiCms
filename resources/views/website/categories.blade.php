@extends('website.app')
@section('content')
    <x-website.ui.breadcrumbs class="bg-accent">
        <div class="text-white page-breadcrumb d-flex align-items-end">
            @if($article->parent)
                <div class="page-breadcrumb-item">{{$article->parent->title}}</div>
            @endif
            <div class="page-breadcrumb-item">{{$article->title}}</div>
        </div>
    </x-website.ui.breadcrumbs>
    <main class="my-2">
        <div class="container">
            <h1 class="text-primary">{{ $article->title }}</h1>

            <ul>
                @foreach ($categories as $category)
                    <li><a href="{{ $category->getPermalink() }}">{{ $category->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </main>

@endsection
