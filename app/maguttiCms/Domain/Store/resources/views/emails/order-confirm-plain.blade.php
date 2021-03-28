@extends('emails.master.plain')
@section('content')
    {{__('store.order.number')}}:{{$order->reference}}
    {{ trans('store.order.date') }}: {{$order->created_at->format('d-m-Y')}}
@endsection
