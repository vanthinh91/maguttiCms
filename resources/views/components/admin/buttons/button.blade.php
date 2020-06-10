@props(['icon','type','title'=>''])
<a {{ $attributes->merge(['class' => 'btn']) }}
   @if($title)
      title="{{trans($title) }}"
      data-toggle="tooltip"
      data-placement="bottom" rel="tooltip"
   @endif
   data-role="{{$type}}-item">
   {{icon($icon??$type)}}
   @if (config('maguttiCms.admin.option.list.show-labels'))
      {!! trans('admin.label.'.$type)!!}
   @endif
</a>