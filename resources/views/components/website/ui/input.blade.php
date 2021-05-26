@props(['name' => 'generic'])
<input type="{{$type}}"
       {!! $attributes->merge(['class' =>"form-control"])!!}
       {!! $attributes['placeholder']!!}
       class="form-control" id="{{$for}}" name="{{$for}}"
       value="{{ old($for) }}" >

<x-website.ui.input-error-label for="{{$for}}"/>