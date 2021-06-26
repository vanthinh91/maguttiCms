var uploaded= false

$( function()
{

  const $modal = $('#filemanager');

  /*
  * When the user clicks on upload button, open the modal
  * with input name and current value
  */
  $('.filemanager-select').on('click', function(e) {

    e.preventDefault();
    $modal.modal('show');
    let inputName = $(this).data('input');
    let inputValue = $('input[name='+ inputName +']').val();

    // If 'inputValue' value is != 0, open library tab
    if(inputValue != 0) {
      window.$eventBus.$emit('FILE_MANAGER_SELECT_ITEM',inputValue)
      window.$eventBus.$emit('FILE_MANAGER_LOAD_LIST',inputValue)
      $('#file-manager-list').click();
    }
    else {
      window.$eventBus.$emit('FILE_MANAGER_LOAD_LIST',inputValue)
      window.$eventBus.$emit('FILE_MANAGER_SELECT_ITEM',null)
    }
    // Set modal hidden input values
    $('input[name=file-input]', $modal).val(inputName);
    $('input[name=file-value]', $modal).val(inputValue);

  });

  /*
  * Tab upload, uploadifive method
  */
  $('input[name=upload-input]', $modal).uploadifive({
    'auto': true,
    'queueID': 'queue-modal',
    'uploadScript': urlAjaxHandlerCms + 'filemanager/upload',
    'onAddQueueItem': function(file) {
      this.data('uploadifive').settings.formData = {
        '_token': $('[name=_token]').val()
      };
    },
    'onUploadComplete' : function(file, data) {
      var responseObj = jQuery.parseJSON(data);
      var mediaType   =  responseObj.data;

      // Set media id in modal hidden value
      $('input[name=file-value]', $modal).val(responseObj.id);
      // Switch to 'library' tab
      uploaded =true
      $('#file-manager-list').trigger('click');
    }
  });

  /*
  * When the user clicks on 'library' tab, load all images
  */
  $('#file-manager-list').on('click', function(e) {

      let input_obj    = $('.filemanager-select').data("input");
      let media_obj_id = (parseInt($('input[name='+input_obj+']').val()))?parseInt($('input[name='+input_obj+']').val()):'' ;
      let request_url = `${urlAjaxHandlerCms}filemanager/list/${media_obj_id }`;

      window.$eventBus.$emit('FILE_MANAGER_LOAD_LIST',media_obj_id)
      let fileValue = $('input[name=file-value]').val();

      $('.modal-footer', $modal).removeClass('visually-hidden');
      // If user is in edit mode, set media as active and load sidebar
      if(fileValue != 0) {
        $('#file-manager-upload', $modal).removeClass('active');
        $('#file-manager-list', $modal).addClass('active');
        $('#tab-upload', $modal).removeClass('active show');
        $('#tab-images', $modal).addClass('active show')
        $('#media-id-' + fileValue).addClass('active');
        if(uploaded!=true)window.$eventBus.$emit('FILE_MANAGER_LOAD_LIST',fileValue)
        window.$eventBus.$emit('FILE_MANAGER_SELECT_ITEM',fileValue)
        window.$eventBus.$emit('FILE_MANAGER_UPDATE_SIDE_BAR',fileValue)
        uploaded =false;
      }
  });




  /*
  * Sidebar: update image data
  */
  $(document).on('submit', '#filemanager-edit-form', function (e) {

    e.preventDefault();

    let  form = $(this);

    // Make ajax request to edit media data
    $.ajax({
      type: 'POST',
      url: form.attr('action'),
      data: form.serialize(),
      dataType: 'json',
      success: function(response) {
        $.notify(response.message, 'success');
        // Switch to 'library' tab
        $('#file-manager-list').trigger('click');
      },
      error: function(response) {
        $.notify('Error.');
      }
    });

  });

  /*
  * When the user clicks resets button, remove current active and reset hidden input value
  */
  $('.reset-image', $modal).on('click', function(e) {
    e.preventDefault();
    // Remove all 'is-active' classes
    window.$eventBus.$emit('FILE_MANAGER_RESET')
  });

  /*
  * When the user confirm an image from filemanager,
  * set image id as new value in admin form input and close the modal
  */
  $('.confirm-image', $modal).on('click', function(e) {
    e.preventDefault();
    // Set admin form input value
    $('input[name='+ $('input[name=file-input]', $modal).val() +']').val($('input[name=file-value]', $modal).val());
    // Close modal
    $modal.modal('hide');
  });

  /*
   * When the user close the modal, reset sidebar and loader.
   */
  $('#filemanager').on('hidden.bs.modal', function () {
    $('#tab-upload',$modal).addClass('active show');
    $('#tab-images',$modal).removeClass('active show')
    $('#file-manager-upload',$modal).addClass('active');
    $('#file-manager-list',$modal).removeClass('active');
    // Reset sidebar content
    $('#sidebar-content').html('');
  });

} );
