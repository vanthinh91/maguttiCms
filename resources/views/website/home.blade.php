@inject('hpslider','App\HpSlider')
<x-website.layout></x-website.layout>
@section('footerjs')
	<script type="text/javascript">
		$('#carousel').owlCarousel({
			items:1,
			loop:true,
			dots:true,
			nav:false
		});
	</script>
@endsection
