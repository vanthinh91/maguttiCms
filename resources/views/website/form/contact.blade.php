{{ Form::open(array('action' => '\App\maguttiCms\Website\Controllers\WebsiteFormController@getContactUsForm')) }}
<div class="row g-3">
    @if(isset($request_product_id))
        @if(isset($product))
            <div class="col-12">
				<x-website.ui.input type="hidden" for="request_product_id" placeholder="{{ trans('website.name') }}" required/>
                {!! trans('website.message.product_request') !!}
                <mark>{{$product->title}}</mark>
            </div>
        @endif
    @endif
    <div class="col-12 col-sm-6">
        <x-website.ui.input for="name" placeholder="{{ trans('website.name') }}*" required/>
    </div>
    <div class="col-12 col-sm-6">
        <x-website.ui.input for="surname" placeholder="{{ trans('website.surname') }} *" required/>
    </div>
    <div class="col-12 col-sm-6">
        <x-website.ui.input type="email" for="email" placeholder="{{ trans('website.email') }} *" required/>
    </div>
    <div class="col-12 col-sm-6">
        <x-website.ui.input for="company" placeholder="{{ trans('website.employer') }} *" required/>
    </div>
    <div class="col-12">
        <x-website.ui.input for="subject" placeholder="{{ trans('website.subject') }}*" required/>
    </div>
    <div class="col-12">
		<x-website.ui.textarea for="message" placeholder="{{ trans('website.message_email') }}*" rows="5" required/>
    </div>
    <div class="col-12 col-sm-12">
        <x-website.widgets.privacy-message/>
    </div>
    @if (data_get($site_settings,'captcha_site'))
        <div class="col-12 col-sm-6">
            <div class="pull-end">
                <div class="g-recaptcha" data-sitekey="{{data_get($site_settings,'captcha_site')}}"></div>
            </div>
        </div>
    @endif
    <div class="col-12 col-sm-6 ">
		<button type="submit" class="btn btn-primary">{{ trans('website.send') }}</button>
    </div>
</div>
{{ Form::close() }}
