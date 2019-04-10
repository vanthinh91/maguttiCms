@if (!isset($_COOKIE['euCookie']))
    <div id="cookie-notice">
		<div id="cookie-notice-wrapper">
			<p>
				{!! trans('website.message.cookie')!!}<br>
			</p>
			<div id="cookie-notice-buttons">
				<a href="https://www.iubenda.com/privacy-policy/{{ data_get($site_settings,'iubenda_code_'.LaravelLocalization::getCurrentLocale()) }}/cookie-policy" class="btn btn-primary iubenda-nostyle no-brand iubenda-embed policy" title="{{ trans('website.cookie')}}">
					{!! trans('website.message.cookie_more_info')!!}
				</a>
				<a id="cookie-accept" class="btn btn-accent">
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
						secure			: true
					@endif
                }
            )
        })
    </script>
@endif
