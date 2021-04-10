<x-admin.card.side-bar id="page-block-list">
    <x-slot name="title">{!! trans('admin.label.page-blocks')!!}</x-slot>
    <ul>
        <li>
            <a href="{{ma_get_admin_create_url('block')}}?model={{$model}}"
               class="nav-link btn btn-info btn-sm mb-3">{{icon('plus')}}{!! trans('admin.message.add_block')!!}</a>
        </li>
        @foreach($item->blocks as $block)
            <li>
                <a href="{{ma_get_admin_edit_url($block)}}">- {!! $block->title !!}</a>
            </li>
        @endforeach
    </ul>
</x-admin.card.side-bar>

