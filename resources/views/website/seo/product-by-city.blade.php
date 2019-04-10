@extends('website.app')
@section('content')
	<!--=== Content Part ===-->
	<main class="container">
		<h1 class="bordered">{{ $article->title }}</h1>
		{!! $article->description !!}
		<ul>
			@foreach ($province->cities()->inRandomOrder()->take(10)->get() as $_city)
				<li>{{$_city->name}}</li>
			@endforeach
		</ul>
		<div id="seo-map"></div>
	</main>
@endsection

@section('footerjs')
	@parent
	<script async defer src="https://maps.googleapis.com/maps/api/js?key={{data_get($site_settings,'GMAPS_KEY')}}&callback=initMap"></script>
	<script>
	function initMap() {
		var capoluogo = {lat: {{$province->lat}}, lng: {{$province->lng}}};
		var map = new google.maps.Map(document.getElementById('seo-map'), {
			zoom: 10,
			center: capoluogo
		});
		var marker = new google.maps.Marker({
			position: capoluogo,
			map: map
		});
	}
</script>
@endsection
