<div id="action-bar">
    <x-admin.page-title :article="$article??''" :model="$model??''"></x-admin.page-title>
    <div class="actions">
        <button id="toolbar_deleteButtonHandler" class="btn btn-danger btn-lg" data-role="deleteAll"
                rel="tooltip"
                data-placement="bottom"
                data-toggle="tooltip"
                title="{!! trans('admin.message.delete_items')!!}"
                data-original-title="{!! trans('admin.message.delete_items')!!}"
                style="display: none;">
            @if (config('maguttiCms.admin.option.action-bar.show-labels'))
                {{trans('admin.label.delete')}}
            @endif
            {{icon('trash')}}
        </button>
        @if (Str::contains($view_name, '-edit'))
            <x-admin.buttons.back_to_list class="btn-default btn-lg"  :article="$article"/>
            @if (auth_user('admin')->action('preview',$pageConfig) && $article->id)
                <x-admin.buttons.preview class="btn-default btn-lg"  :article="$article"/>
            @endif
            <x-admin.buttons.save class="btn-default btn-lg"/>
            @if (auth_user('admin')->action('copy',$pageConfig) && $article->id)
                <x-admin.buttons.copy class="btn-default btn-lg"  :article="$article"/>
            @endif
        @endif
        @if ($view_name == 'admin-list' && auth_user('admin')->action('export_csv',$pageConfig))
            <x-admin.buttons.export_to_csv class="btn-default btn-lg"  :article="$pageConfig['model']"/>
        @endif
        @if (auth_user('admin')->action('create',$pageConfig))
            <x-admin.buttons.create class="btn-default btn-lg"  :article="$pageConfig['model']"/>
        @endif
    </div>
</div>
