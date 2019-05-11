@extends('website.app')
@section('content')

	<main class="my-5 bg">
        <div class="container">
            <h1 class="text-secondary">{{ $article->title }}</h1>

			<ul>
				@foreach ($categories as $category)
					<li><a href="{{ $category->getPermalink() }}">{{ $category->title }}</a></li>
				@endforeach
			</ul>
        </div>
    </main>

@endsection
