@php $article = isset($article) ? $article : null; @endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<a class="navbar-brand" href="{{ url_locale('/') }}">
			<img src="{{ asset('website/images/logo.png') }}" alt="{{ config('maguttiCms.website.option.app.name') }}" class="img-fluid">
		</a>

		<a class="navbar-call" href="tel:{{ config('maguttiCms.website.option.app.phone') }}">
			{{ icon('circle,phone', 'fa-rotate-90') }}
		</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbar">
			{!! HtmlMenu::setCurrentPage($article)->navbar() !!}
		</div>
	</div>
</nav>
