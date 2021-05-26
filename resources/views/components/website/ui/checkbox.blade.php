<div {!! $attributes->merge(['class' =>"form-check"])!!}>
    <input type="checkbox" class="form-check-input" {{$attributes}}
           name="{{$for}}"  id="{{$for}}" >
    <label class="form-check-label" for="{{$for}}">
        {{$slot}}
    </label>
    <x-website.ui.input-error-label class="pt-1" for="{{$for}}"></x-website.ui.input-error-label>
</div>