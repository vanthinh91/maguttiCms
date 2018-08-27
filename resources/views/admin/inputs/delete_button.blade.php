<a href="#" rel="tooltip" class="btn btn-danger ml10"
            data-original-title="{{trans('admin.message.delete_item')}}"
            onclick="window.Cms.deleteImages(this)" id="{{"delete-".$key}}-{{$id}}">
            <i class="fa fa-trash big"></i>
</a>


<a id="delete-{{$key}}-{{$id}}"
   class="btn btn-danger media-delete"
   href="#"
   rel="tooltip"
   data-original-title="{{trans('admin.message.delete_item')}}"
   onclick="window.Cms.deleteImages(this)">
   {{icon('trash')}}
</a>
