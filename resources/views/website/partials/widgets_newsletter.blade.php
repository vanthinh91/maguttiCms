{{ Form::open(array('id' => 'form-newsletter', 'name' => 'form-newsletter', 'action' => '\App\maguttiCms\Website\Controllers\APIController@subscribeNewsletter')) }}
	<div class="form-inline">
		<div class="form-group">
			<div class="input-group">
				<input class="form-control mr-2" type="text" name="email" placeholder="{{ trans('website.newsletters_placeholder') }}" required>
			</div>

			<button id="btn-newsletter-subscribe" type="submit" class="btn btn-primary">
				{{ trans('website.send') }}
			</button>
		</div>
	</div>

	<div class="form-group">
		<div class="custom-control custom-checkbox pl-0 mt-2">
			<div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" name="privacy" value="1" id="newsletter-privacy" required>

				<label class="custom-control-label" for="newsletter-privacy">
					<a href="https://www.iubenda.com/privacy-policy/{{ data_get($site_settings,'iubenda_code_'.LaravelLocalization::getCurrentLocale()) }}" class="iubenda-nostyle no-brand iubenda-embed " title="{{ trans('website.privacy')}}">
						{{trans('website.message.privacy')}}
					</a>
				</label>

				{{ $errors->first('privacy') }}
			</div>
		</div>
	</div>
{{ Form::close() }}
