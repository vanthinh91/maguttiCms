@extends('emails.master.html')
@section('content')
	<p>{{ trans('website.mail_message.contact')}}:</p>
	<ul>
		<li><b>{{ trans('website.name')}}</b>: {{ $data['name'] }} {{ $data['surname'] }}</li>
		<li><b>{{ trans('website.employer')}}</b>: {{ $data['company'] }}</li>
		<li><b>{{ trans('website.email')}}</b>: {{ $data['email'] }}</li>
		@if ($data['product'])
			<li><b>Info request from product</b>: {{ $data['product'] }}</li>
		@endif
	</ul>
	<br />
	<p>
		<b>{{ trans('website.message_email')}}</b></p>
	    <p>
		@foreach ($data['messageLines'] as $messageLine)
			{{ $messageLine }}<br>
		@endforeach
	</p>
@endsection
