@include('flash::notification')
<div class="row">
	{{ Form::open(array('action' => '\App\maguttiCms\Website\Controllers\WebsiteFormController@getContactUsForm')) }}
		@if(isset($request_product_id))
			@if(isset($product))
				<div class="col-xs-12">
					{{ Form::hidden('request_product_id', $request_product_id, ['class' => 'form-control']) }}
					<div class="form-group">
						{!! trans('website.message.product_request') !!}
						<mark>{{$product->title}}</mark>
					</div>
				</div>
			@endif
		@endif
		<div class="col-xs-12 col-sm-6">
		    <div class="form-group">
		        {{ Form::text('name', null,  ['class' => 'form-control', 'required', 'placeholder' => trans('website.name')]) }}
		        {{ $errors->first('name') }}
		    </div>
	    </div>
		<div class="col-xs-12 col-sm-6">
		    <div class="form-group">
		        {{ Form::text('surname', null,  ['class' => 'form-control', 'required', 'placeholder' => trans('website.surname')]) }}
		        {{ $errors->first('surname') }}
		    </div>
	    </div>
		<div class="col-xs-12 col-sm-6">
			<div class="form-group">
				{{ Form::email('email', null,  ['class' => 'form-control', 'required', 'placeholder' => trans('website.email')]) }}
				{{ $errors->first('email') }}
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
		    <div class="form-group">
		        {{ Form::text('company', null,  ['class' => 'form-control', 'placeholder' => trans('website.employer')]) }}
		        {{ $errors->first('company') }}
		    </div>
	    </div>
		<div class="col-xs-12">
		    <div class="form-group">
		        {{ Form::text('subject', null,  ['class' => 'form-control', 'required', 'placeholder' => trans('website.subject')]) }}
		        {{ $errors->first('subject') }}
		    </div>
	    </div>
		<div class="col-xs-12">
		    <div class="form-group">
		        {{ Form::textarea('message', null,  ['class' => 'form-control', 'rows' => 5, 'required', 'placeholder' => trans('website.message_email')]) }}
		        {{ $errors->first('message') }}
		    </div>
	    </div>
		<div class="col-xs-12 col-sm-6">
		    <div class="form-group">
				<div class="form-checkbox">
					<input type="checkbox" class="form-input" name="privacy" value="1" id="privacy" required>
					<label for="privacy">
						<a href="https://www.iubenda.com/privacy-policy/{{ data_get($site_settings,'iubenda_code_'.LaravelLocalization::getCurrentLocale()) }}" class="iubenda-nostyle no-brand iubenda-embed " title="{{ trans('website.privacy')}}">
							{{trans('website.message.privacy')}}
						</a>
					</label>
					{{ $errors->first('privacy') }}
				</div>
		    </div>
	    </div>
		@if (data_get($site_settings,'captcha_site'))
			<div class="col-xs-12 col-sm-6">
				<div class="form-group pull-right">
					<div class="g-recaptcha" data-sitekey="{{data_get($site_settings,'captcha_site')}}"></div>
				</div>
			</div>
		@endif
		<div class="col-xs-12">
		    <div class="form-group ">
		        {{ Form::submit(trans('website.send'), array('class' => 'btn btn-lg btn-primary btn-block')) }}
	    	</div>
	    </div>
	{{ Form::close() }}
</div>
