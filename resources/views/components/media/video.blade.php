@if($video)
<div class="embed-responsive embed-responsive-{{ $ratio }} {{ $extra_class ?? '' }}">
    <iframe class="embed-responsive-item" src="{{ $url }}" allowfullscreen></iframe>
</div>
@endif