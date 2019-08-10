{{-- seo_links --}}
 @include('website.partials.seo_links')

<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-sm-6">
                @include('website.partials.widgets_newsletter')
            </div>
            <div class="col-12 col-sm-6">
                <ul class="footer-social">
                	{!! HtmlSocial::get()->render() !!}
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row align-items-end">
            <div class="col-12 col-md-8">
                <h5 class="text-primary">{{ config('maguttiCms.website.option.app.name') }}</h5>

                <div>
                    &copy; <?php echo date('Y'); ?> {{ config('maguttiCms.website.option.app.legal') }}<br>
                    {{ config('maguttiCms.website.option.app.address') }} - {{ config('maguttiCms.website.option.app.locality') }} - P.IVA {{ config('maguttiCms.website.option.app.vat') }}<br>
                    Tel: {{ config('maguttiCms.website.option.app.phone') }} - Fax: {{ config('maguttiCms.website.option.app.fax') }} - <a href="mailto:{{ config('maguttiCms.website.option.app.email') }}">{{ config('maguttiCms.website.option.app.email') }}</a>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="text-md-right">
                    <a href="https://www.iubenda.com/privacy-policy/{{ data_get($site_settings,'iubenda_code_'.LaravelLocalization::getCurrentLocale()) }}" class="lightbox-iframe" title="{{ trans('website.privacy')}}">
                        {{ trans('website.privacy')}}
                    </a> |
                    <a href="https://www.iubenda.com/privacy-policy/{{ data_get($site_settings,'iubenda_code_'.LaravelLocalization::getCurrentLocale()) }}/cookie-policy" class="lightbox-iframe" title="{{ trans('website.cookie')}}">
                        {{ trans('website.cookie')}}
                    </a> |
                    <a href="{{ data_get($site_settings,'credits_url') }}" target="_blank">Credits</a>
                </div>
            </div>
        </div>
    </div>
</footer>
