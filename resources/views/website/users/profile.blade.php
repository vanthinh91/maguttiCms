@extends('website.app')
@section('content')

	<main class="my-5">
        <div class="container">
            <h1 class="text-primary">{{ $article->title }}</h1>

			{!! $article->description !!}
		</div>
	</main>
	
@endsection
