{{ Form::open(array('id' => 'form-newsletter', 'class' =>'row gy-2', 'name' => 'form-newsletter', 'action' => '\App\maguttiCms\Website\Controllers\APIController@subscribeNewsletter')) }}
<div class="d-grid gy-3 mb-0">
    <div class="input-group input-group-sm">
        <input type="email"
           class="form-control footer-newsletter-input"
           name="email" placeholder="{{ trans('website.newsletters_placeholder') }}"
           required>
           <button id="btn-newsletter-subscribe" type="submit" class="btn btn-primary">
             {{ trans('website.send') }}
          </button>
    </div>
    <x-website.widgets.privacy-message class="pt-2"/>
</div>
{{ Form::close() }}