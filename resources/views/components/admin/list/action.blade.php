@if (auth_user('admin')->action('edit',$pageConfig))
    <x-admin.buttons.edit :article="$article"/>
@endif
@if (auth_user('admin')->action('copy',$pageConfig))
    <x-admin.buttons.copy :article="$article"/>
@endif
@if (auth_user('admin')->action('view',$pageConfig))
    <x-admin.buttons.view :article="$article"/>
@endif
@if (auth_user('admin')->action('delete',$pageConfig))
    <x-admin.buttons.delete :article="$article"/>
@endif
@if (data_get($pageConfig,'impersonated') && cmsUserHasRole('su'))
    <x-admin.buttons.impersonated :article="$article"/>
@endif

