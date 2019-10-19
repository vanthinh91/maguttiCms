<h3>{!! trans('admin.label.actions')!!}</h3>
<hr>
<ul>
	@if ($pageConfig['copy']==1 && $article->id!='')
		<li>
			<a href="{{ma_get_admin_copy_url($article)}}">{{icon('copy')}}{!! trans('admin.label.copy')!!}</a>
		</li>
		<li>
			<a href="{{ma_get_admin_edit_url($article->model)}}">{{icon('reply')}}{!! trans('admin.label.back_to')!!} {{$article->model->title}}</a>
		</li>
	@endif
</ul>