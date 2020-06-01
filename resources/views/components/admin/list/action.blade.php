@if (auth_user('admin')->action('edit',$pageConfig))
    <x-admin.button.edit :article="$article" class="btn-info"/>
@endif
@if (auth_user('admin')->action('copy',$pageConfig))
    <x-admin.button.copy :article="$article" class="btn-info"/>
@endif
@if (auth_user('admin')->action('view',$pageConfig))
    <a href="{{  ma_get_admin_view_url($article) }}" class="btn btn-primary"
       data-role="edit-item">
        {{icon('eye')}}
        @if (config('maguttiCms.admin.option.list.show-labels'))
            {!! trans('admin.label.view')!!}
        @endif
    </a>
@endif
@if (auth_user('admin')->action('delete',$pageConfig))
    <x-admin.button.delete :article="$article" class="btn-danger"/>
@endif
@if (data_get($pageConfig,'impersonated') && cmsUserHasRole('su'))
    <a href="{{  ma_get_admin_impersonated_url($article) }}" target="new"
       class="btn btn-warning">
        {{icon('users')}}
    </a>
@endif

