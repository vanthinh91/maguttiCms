<copyable-input-component
  readonly=true
  name="{!! $item->getItemProperty('field') !!}[]"
  btn_class="btn"
  input_text="{{ $item->getValue()}}">
</copyable-input-component>

