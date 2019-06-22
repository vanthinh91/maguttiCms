@extends('website.app')
@section('content')

	<main class="my-5">
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
