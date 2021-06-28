<footer class="footer">
    <section class="footer-widgets bg-color-4 py-3">
        <div class="container ">
            <div class="row align-items-center ">
                <div class="col-12 col-md-6 footer-newsletter">
                    <x-website.widgets.newsletter/>
                </div>
                <div class="col-12 col-md-6">
                    <x-website.widgets.social/>
                </div>
            </div>
        </div>
    </section>
    <section class="footer-info bg-primary py-2">
        <div class="container ">
            <div class="row align-items-end">
                <div class=" d-grip col-12 col-md-8 footer-address">
                    <h4 class="text-center text-md-start">{{ config('maguttiCms.website.option.app.name') }} </h4>

                    <div class="footer-address-content">
                        &copy; <?php echo date('Y'); ?> {{ config('maguttiCms.website.option.app.legal') }} - Ver. {{ App::VERSION() }} <br>
                        {{ config('maguttiCms.website.option.app.address') }} - {{ config('maguttiCms.website.option.app.locality') }} - P.IVA {{ config('maguttiCms.website.option.app.vat') }}<br>
                        Tel: {{ config('maguttiCms.website.option.app.phone') }} - Fax: {{ config('maguttiCms.website.option.app.fax') }} - <a href="mailto:{{ config('maguttiCms.website.option.app.email') }}">{{ config('maguttiCms.website.option.app.email') }}</a>
                    </div>
                </div>

                <div class="col-12 col-md-4 footer-legal">
                    <div class="text-center text-md-end">
                        <a href="{{page_permalink_by_id(3)}}"  target="_blank" title="{{ trans('website.privacy')}}">
                            {{ trans('website.privacy')}}
                        </a> |
                        <a href="{{page_permalink_by_id(20)}}" target="_blank" title="{{ trans('website.cookie')}}">
                            {{ trans('website.cookie')}}
                        </a> |
                        <a href="{{ data_get($site_settings,'credits_url') }}" target="_blank">Credits</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>