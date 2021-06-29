@extends('website.app')
@section('content')
	<x-website.partials.page-header  :title="$article->title"/>
	<main class="my-3">
		<div class="container">
			<x-website.users.validation-success/>
			<x-website.users.update-profile/>
			<x-website.users.separator/>
			<x-website.users.update-password/>
		</div>
	</main>

@endsection
