<div class="input-group">
    <input
            id="{!! $item->getConfigProperty('model').'_'.$item->getItemProperty('field').'_'.$item->getId() !!}"
            class="form-control"
            name="{!! $item->getItemProperty('field') !!}[]"
            readonly="readonly" value="{{ $item->getValue()  }}"
            data-list-value="{{ $item->getConfigProperty('model').'_'.$item->getId() }}"
            data-list-name="{{ $item->getItemProperty('field') }}"
            autocomplete="off"
    />
    <div class="input-group-append">
        <span title="Copia il contenuto nel clipboard"
              data-toggle="tooltip"
              data-placement="bottom"
              class=" btn btn-info copy-to-clipboard">
          <i aria-hidden="true" class="fa fa-clipboard"></i></span>
    </div>
</div>

<script>
    function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        alert("Copied the text: " + copyText.value);
    }
</script>

