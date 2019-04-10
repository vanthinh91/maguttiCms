{{ Form::open(array('id' => 'form-newsletter', 'name' => 'form-newsletter', 'class'=>'form-inline', 'action' => '\App\maguttiCms\Website\Controllers\APIController@subscribeNewsletter')) }}
<div class="input-group">
	<input class="form-control"
	type="text"
	id="email"
	name="email"
	placeholder="{!! trans('website.newsletters_placeholder') !!}"
	required
	>

	<div class="input-group-btn">
		<button id="btn-newsletter-subscribe" class="btn btn-newsletter btn-full" type="submit">
			{{trans('website.send')}}
		</button>
	</div>
</div>
<div class="form-group">
	<input type="checkbox" class="form-input" name="privacy" value="1" id="privacy" required>
	<label for="privacy">
		<a href="https://www.iubenda.com/privacy-policy/{{ data_get($site_settings,'iubenda_code_'.LaravelLocalization::getCurrentLocale()) }}" class="iubenda-nostyle no-brand iubenda-embed " title="{{ trans('website.privacy')}}">
			{{trans('website.message.privacy')}}
		</a>
	</label>
	{{ $errors->first('privacy') }}
</div>
{{ Form::close() }}
