<div {!! $attributes->merge(['class' =>""])!!}>
    <x-website.ui.checkbox for="privacy" required  value="1">
        <a href="https://www.iubenda.com/privacy-policy/{{ data_get($site_settings,'iubenda_code_'.LaravelLocalization::getCurrentLocale()) }}"
           class="iubenda-nostyle no-brand iubenda-embed " title="{{ trans('website.privacy')}}">
            {{trans('website.message.privacy')}}
        </a>
    </x-website.ui.checkbox>
</div>
