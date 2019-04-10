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
									@if (
											$admin_can_edit
											&& (
												data_get($pageConfig, 'edit')
												|| data_get($pageConfig, 'copy')
												|| data_get($pageConfig, 'view')
												|| data_get($pageConfig, 'delete')
												|| data_get($pageConfig, 'impersonated')
											)
										)
										<th>{!! trans('admin.label.actions')!!}</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($articles as $article)
									<tr id="row_{!! $article->id !!}">
										@if ($pageConfig['selectable'])
											<td class="selectable-column">
												<div class="form-checkbox">
													<input type="checkbox" value="{!! $article->id !!}" id="list_{!! $article->id !!}" name="list[{!! $article->id !!}]" class="checkbox" autocomplete="off">
												</div>
											</td>
										@endif
										@foreach($labels=$pageConfig['field'] as $label)
											<td class="{{isset($label['class'])? $label['class']: ''}}">
												@if (is_array($label))
													@if ( $label['type'] == 'date' )
														{!! Carbon::parse($article->{$label['field']})->format('d/m/Y') !!}
													@elseif ($label['type'] == 'upload')
														<a href=" {!! ma_get_upload_from_repository($article->{$label['field']}) !!}" target="_new" download>
															{!! trans('admin.label.download')!!}
														</a>
													@elseif ($label['type'] == 'image' && $article->{$label['field']} != '')
														@php
															$field = $fieldspec[$label['field']];
															$disk = isset($field['disk'])? $field['disk']: '';
															$folder = isset($field['folder'])? $field['folder']: '';
															$file = $article->{$label['field']};
															// $image = ma_get_file_from_storage($file, $disk, $folder);
															$image = ma_get_image_from_repository($file, $disk, $folder);
															$thumb = ImgHelper::get_cached($file, config('maguttiCms.image.admin'), $disk, $folder);
														@endphp
														<a href="{{$image}}" class="red" target="_new">
															<img src="{{$thumb}}"  class="img-thumb">
														</a>
													@elseif ($label['type'] == 'boolean')
														@php
															if (data_get($label, 'relation')) {
																$relationObj = AdminDecorator::getBooleanRelation($article, $label);
															} else {
																$relationObj = null;
															}
															if ($relationObj) {
																$value = $relationObj->{$label['field']};
																$model = $label['model'];
																$id = $relationObj->id;
															} else {
																$value = $article->{$label['field']};
																$model = $pageConfig['model'];
																$id = $article->id;
															}
														@endphp
														@if (data_get($label, 'relation') && $relationObj || !data_get($label, 'relation'))
															@if (data_get($label, 'editable') && $admin_can_edit)
																<div class="bool-toggle" data-list-boolean="{!! $model.'_'.$id !!}" data-list-name ="{!! $label['field']!!}">
																	<span class="bool-on {{($value)? '' : 'hidden'}}">
																		{{AdminDecorator::getBooleanOn()}}
																	</span>
																	<span class="bool-off {{($value)? 'hidden' : ''}}">
																		{{AdminDecorator::getBooleanOff()}}
																	</span>
																</div>
															@else
																<div class="bool-toggle">
																	@if ($value == 1)
																		<i class="text-success">{{AdminDecorator::getBooleanOn()}}</i>
																	@else
																		<i class="text-danger">{{AdminDecorator::getBooleanOff()}}</i>
																	@endif
																</div>
															@endif
														@endif
													@elseif ($label['type'] == 'editable' && $admin_can_edit)
														<input
															id="{!! $pageConfig['model'].'_'.$label['field'].'_'.$article->id !!}"
															class="form-control"
															name="{!! $label['field'] !!}[]"
															type="text" value="{{ $article->{$label['field']}  }}"
															data-list-value ="{!! $pageConfig['model'].'_'.$article->id !!}"
															data-list-name ="{!! $label['field']!!}"
															autocomplete="off"
														/>
													@elseif ($label['type'] == 'relation')
														@if(isset($label['editable']) && $label['editable'] && $admin_can_edit)
															@php
																$relationObj     = AdminDecorator::getRelation($label);
																$selectObjValue  = AdminDecorator::getSelectRelationItemValue($label,$article->{$label['field']});
																$emptyLabel		 = (isset($label['label_empty']) && $label['label_empty'])? $label['label_empty']: '';
															@endphp
															<select id="{!! $pageConfig['model'].'_'.$label['field'].'_'.$article->id !!}"
																name="{!! $label['field'] !!}"
																data-list-value ="{!! $pageConfig['model'].'_'.$article->id !!}"
																data-list-name ="{!! $label['field']!!}"
																class="btn-select form-control"
																>
																@if ($emptyLabel)
																	<option value="">{{ $emptyLabel }}</option>
																@endif
																@foreach($relationObj as $item)
																	<option
																	<?php echo AdminDecorator::selectedHandler($item->{$label['foreign_key']}, $article->{$label['field']}); ?>
																	value="{{ $item->{$label['foreign_key']} }}"
																	>
																		{{ $item->{$label['label_key']} }}
																	</option>
																@endforeach
															</select>
														@elseif ($article->{$label['relation']})
															@if (isset($label['multiple']) && isset($label['multiple'])==true)
																{!!implode(',',$article->{$label['relation']}->pluck($label['field'])->sortBy($label['field'])->toArray()) !!}
															@else
																{!! $article->{$label['relation']}->{$label['field']} !!}
															@endif
														@endif
													@elseif ($label['type'] == 'relation_image')
														@if($article->{$label['relation']} != null)
															<a href="{!! ma_get_image_from_repository($article->{$label['relation']}->{$label['field']}) !!}" class="red" target="_new">
																<img src="{!! ImgHelper::get_cached($article->{$label['relation']}->{$label['field']}, config('maguttiCms.image.admin')) !!}" class="img-thumb">
															</a>
														@endif
													@elseif ($label['type'] == 'color')
														<div class="color" style="background-color: {{ $article->{$label['field']} }}"></div>
													@elseif ($label['type'] == 'locale')
														<img class="flag" src="{{asset('website/images/flags/'.$article->{$label['field']}.'.png')}}" alt="{{ $article->{$label['field']} }} flag">
													@else
														{!! $article->{$label['field']} !!}
													@endif
												@else
													{!! $article->$label !!}
												@endif
											</td>
										@endforeach
										@if (
												$admin_can_edit
												&& (
													data_get($pageConfig, 'edit')
													|| data_get($pageConfig, 'copy')
													|| data_get($pageConfig, 'view')
													|| data_get($pageConfig, 'delete')
												)
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
			<div class="pagination">{!! $articles->render() !!}</div>
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
