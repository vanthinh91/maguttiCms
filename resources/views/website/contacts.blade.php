@extends('website.app')
@section('content')
<section>
	<div id="map" class="map" ></div>
</section>
<main class="container">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			@include('website.form.contact')
		</div>
		<div class="col-xs-12 col-md-6">
			<address>
				<h3>{!! config('laraCms.website.option.app.name')!!}</h3>
				<p>
					{!! config('laraCms.website.option.app.address')!!}<br>
					{!! config('laraCms.website.option.app.locality')!!}<br>
					{{HtmlHelper::createFAIcon('phone', 'fa-lg mr10')}}Tel {!! config('laraCms.website.option.app.phone')!!}<br>
					{{HtmlHelper::createFAIcon('fax', 'fa-lg mr10')}}Fax {!! config('laraCms.website.option.app.fax')!!}<br>
					{{HtmlHelper::createFAIcon('envelope', 'fa-lg mr10')}}<a href="mailto:{!! config('laraCms.website.option.app.email')!!}">{!! config('laraCms.website.option.app.email')!!}</a>
				</p>
			</address>
		</div>
	</div>
</main>
@endsection
@section('footerjs')
	@parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAp6eZk_5tgJaw4KSfWeP-ibwrHKB7xALk"></script>
    <script type="text/javascript" src="{!! asset( config('laraCms.admin.path.assets').'/website/js/ma_gmaps.js')!!}"></script>
    <!-- JS Page Level -->
    <script type="text/javascript">

        var point;
        var map;
        var gdir;
        var infowindow
        var addressMarker;
        var lat  		={{config('laraCms.website.option.app.lat')}};
        var long 		={{config('laraCms.website.option.app.lng')}};
        var id_page		="";
        var geocoder 	= null;
        var Indirizzo   ="<div class='mapPop'><b>{!! config('laraCms.website.option.app.name')!!} [+]</b><br>{!! config('laraCms.website.option.app.address')!!}<br> {!! config('laraCms.website.option.app.locality')!!}<br></div>"
        var singlePoint = false; // se true  mette un solo punto sulla mappa
        var mapIcons='{!! asset(config('laraCms.admin.path.assets').'website/images/pointer.png') !!}';
        var zoomLevel = 12

        var sites = [
            ['{!! config('laraCms.website.option.app.name')!!}',lat,long,1,Indirizzo]
        ];
        jQuery(document).ready(function() {
            gMap.init();
        });
    </script>
@endsection
