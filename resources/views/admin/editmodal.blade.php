<div class="modal-header">
	<h4 class="modal-title">
		<i class="fa fa-file-text-o"></i>
		@if( $article->title!='')
			Edit {{ $article->title }}
		@elseif( $article->name!='')
			Edit {{ $article->name }}
		@else
			Create new  {{ $pageConfig['model'] }}
		@endif
	</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
	<div id="errorBox">@include('admin.common.error')</div>
    <div class="col-12">
		{{ Form::model($article,['id'=>'media-edit-form','class' =>'form-horizontal']) }}
		{{ AdminForm::get( $article ) }}
		@if ( config('maguttiCms.admin.list.section.'.strtolower(Str::plural($pageConfig['model'])).'s.password')  == 1)
			@include('admin.helper.password')
		@endif
		<hr>
		<div class="d-flex justify-content-between">
			<button type="reset" class="btn btn-danger btn-lg btn-block" data-bs-dismiss="modal">
				{{icon('times')}} Close
			</button>
			<button type="submit" class="btn btn-success btn-lg btn-block">
				{{icon('save')}} Save
			</button>
		</div>
		{{ Form::close() }}
	</div>
</div>

