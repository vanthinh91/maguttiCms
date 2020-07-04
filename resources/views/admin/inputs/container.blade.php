@if(!isset($properties['multi-item']) || data_get($properties,'multi-item','')=='start')
	<div class="row cssRow  form-group {{(isset($properties['cssRow']))? $properties['cssRow']: ''}}">
@endif
	@if (isset($properties['headerLabel']))
		<div class="col-12">
			<h3>{{$properties['headerLabel']}}</h3>
		</div>
	@endif
		<div class="{{ data_get($properties,'label_css','col-12 col-sm-3 col-lg-2')}}">
		@include('admin.inputs.label')
	</div>
	<div class="col-12  {{ ($css_class!='')? $css_class: 'col-sm-9 col-lg-10' }}">
		{!!$form_element!!}
	</div>
@if(!isset($properties['multi-item']) || data_get($properties,'multi-item','')=='stop')
	</div>
@endif

