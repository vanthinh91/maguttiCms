@if (!isset($_COOKIE['euCookie']))
    <div id="cookie-notice" class="cookie-notice">
        <div class="cookie-notice-wrapper">
    		<div class="cookie-notice-message">
    			{!! trans('website.message.cookie')!!}<br>
    		</div>

            <div class="cookie-notice-action mt-2 mt-md-0">
    			<a href="https://www.iubenda.com/privacy-policy/{{ data_get($site_settings,'iubenda_code_'.LaravelLocalization::getCurrentLocale()) }}/cookie-policy" class="btn btn-secondary iubenda-nostyle no-brand iubenda-embed policy my-1" title="{{ trans('website.cookie')}}">
    				{!! trans('website.message.cookie_more_info')!!}
    			</a>
    			<a id="cookie-accept" href="#" class="btn btn-primary my-1">
    				{!! trans('website.message.cookie_accept')!!}
    			</a>
    		</div>
        </div>
    </div>
    <script>
        $(document).ready(function($) {
            var cH = $.maCookieEu(this, {
                    position        : "bottom",
                    cookie_name     : "euCookie",
                    background      : "#1A171E",
                    delete          : true,
					@if (env('APP_HTTPS'))
						secure			: false
					@endif
                }
            )
        })
    </script>
@endif
