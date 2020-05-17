@extends('admin.master')
@section('title', 'Admin Control Panel'.$pageConfig['title'])
@section('content')

	@include('admin.common.action-bar')

	<main id="main-list" class="container-fluid">
		@include('admin.common.search_bar')
		<h2>
			{{icon($pageConfig['icon'])}}
			{{sprintf(trans('admin.label.list_title'), trans('admin.models.'.$model))}}
		</h2>
		@include('shared.notification')
		@if ($articles->isEmpty())
			<div class="alert alert-info">{{trans('admin.message.no_item_found')}}</div>
		@else
			<div class="table-container">
				<form>
					{{ csrf_field() }}
					<div class="table-responsive">
						<table class="admin-table">
							<thead>
								<tr>
									{{ AdminList::initList($pageConfig)->getListHeader() }}
									@if (AdminList::hasAction())
										<th>{!! trans('admin.label.actions')!!}</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($articles as $article)
									<tr id="row_{!! $article->id !!}">
										@if ($pageConfig['selectable'])
											<td class="selectable-column">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" value="{!! $article->id !!}" id="list_{!! $article->id !!}" name="list[{!! $article->id !!}]" class="custom-control-input" autocomplete="off">
													<label class="custom-control-label text-left" for="list_{!! $article->id !!}"> </label>
												</div>
											</td>
										@endif
											@foreach($labels=$pageConfig['field'] as $label)
												<td class="{{isset($label['class'])? $label['class']: ''}}">
													@if (is_array($label))
														@if (AdminList::hasComponent($label['type']))
															{!! AdminList::initList($pageConfig)->makeComponent($article,$label)!!}
														@else
															@if (data_get($label, 'locale'))
																{{ $article->translate($label['locale'])->{$label['field']} }}
															@else
																{{ $article->{$label['field']} }}
															@endif
														@endif
													@else
														{{ $article->$label }}
													@endif
												</td>
											@endforeach
										@if (

													data_get($pageConfig, 'edit')
													|| data_get($pageConfig, 'copy')
													|| data_get($pageConfig, 'view')
													|| data_get($pageConfig, 'delete')

											)
											<td class="list-actions">
												@if ($pageConfig['edit'])
													<a href="{{  ma_get_admin_edit_url($article) }}" class="btn btn-info"   data-role="edit-item">
														{{icon('edit')}}
														@if (config('maguttiCms.admin.option.list.show-labels'))
															{!! trans('admin.label.edit')!!}
														@endif
													</a>
												@endif
												@if ($pageConfig['copy'])
													<a href="{{  ma_get_admin_copy_url($article) }}" class="btn btn-warning"   data-role="edit-item">
														{{icon('copy')}}
														@if (config('maguttiCms.admin.option.list.show-labels'))
															{!! trans('admin.label.copy')!!}
														@endif
													</a>
												@endif
												@if ($pageConfig['view'])
													<a href="{{  ma_get_admin_view_url($article) }}" class="btn btn-primary"   data-role="edit-item">
														{{icon('eye')}}
														@if (config('maguttiCms.admin.option.list.show-labels'))
															{!! trans('admin.label.view')!!}
														@endif
													</a>
												@endif
												@if ($pageConfig['delete'])
													<a href="{{  ma_get_admin_delete_url($article) }}" class="btn btn-danger" data-role="delete-item">
														{{icon('trash')}}
														@if (config('maguttiCms.admin.option.list.show-labels'))
															{!! trans('admin.label.delete')!!}
														@endif
													</a>
												@endif
												@if (data_get($pageConfig,'impersonated') && cmsUserHasRole('su'))
													<a href="{{  ma_get_admin_impersonated_url($article) }}" target="new" class="btn btn-warning">
														{{icon('users')}}
													</a>
												@endif
											</td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</form>
			</div>
		@endif
		@if ($articles->render())
			<div class="pagination mt-4">{!! $articles->render() !!}</div>
		@endif
	</main>
@endsection

@section('footerjs')
	<script src="{!! asset(config('maguttiCms.admin.path.plugins').'selectize/selectize.min.js')!!}" type="text/javascript"></script>
	<script type="text/javascript">
	$(function() {
		$('.selectize').selectize({
			sortField: 'text'
		});
		$('.suggest-remote').selectize({
			valueField: 'id',
			labelField: 'value',
			searchField: 'value',
			sortField: 'text',
			load: function(query, callback) {
				var obj = $(this)[0];
				var cur_item = $('#'+obj.$input["0"].id)
				if (!query.length) return callback();
				$.ajax({
					url: '{!! route('api.suggest') !!}',
					type: 'GET',
					dataType: 'json',
					data: {
						q: query,
						model: cur_item.data('model'),
						value: cur_item.data('value'),
						caption: cur_item.data('caption'),
						searchFields: cur_item.data('fields'),
						accessor: cur_item.data('accessor'),
						where: cur_item.data('where')
					},
					error: function() {
						callback();
					},
					success: function(res) {
						callback(res);
					}
				});
			}
		});
	});
	</script>
@endsection
