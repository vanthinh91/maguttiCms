@extends('emails.master.plain')
@section('content')
{{ trans('website.mail_message.contact')}}:
{{ trans('website.name')}}: {{ $data['name'] }} {{ $data['surname'] }}
{{ trans('website.employer')}}: {{ $data['company'] }}
{{ trans('website.email')}}: {{ $data['email'] }}
@if ($data['product'])
Info request from product: {{ $data['product'] }}
@endif
{{ trans('website.message_email')}}
@foreach ($data['messageLines'] as $messageLine)
    {{ $messageLine }}
@endforeach
@endsection
