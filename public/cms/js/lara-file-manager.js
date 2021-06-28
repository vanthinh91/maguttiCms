/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/admin/lara-file-manager.js ***!
  \*************************************************/
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$(function () {
  var $modal = $('#filemanager');
  /*
  * When the user clicks on upload button, open the modal
  * with input name and current value
  */

  $('.filemanager-select').on('click', function (e) {
    e.preventDefault();
    $modal.modal('show');
    var inputName = $(this).data('input');
    var inputValue = $('input[name=' + inputName + ']').val();

    var params = _objectSpread({}, this.dataset); // get  the element data attribute (dataset)
    // Set modal hidden input values


    $('input[name=file-input]', $modal).val(inputName);
    $('input[name=file-value]', $modal).val(inputValue);
    window.emitterHub.emit('FILE_MANAGER_INIT', inputValue, params); // If 'inputValue' value is != 0, open library tab

    if (inputValue != 0) {
      $('#file-manager-list').click();
    }
  });
  /*
  * Tab upload, uploadifive method
  */

  $('input[name=upload-input]', $modal).uploadifive({
    'auto': true,
    'queueID': 'queue-modal',
    'uploadScript': urlAjaxHandlerCms + 'filemanager/upload',
    'onAddQueueItem': function onAddQueueItem(file) {
      this.data('uploadifive').settings.formData = {
        '_token': $('[name=_token]').val()
      };
    },
    'onUploadComplete': function onUploadComplete(file, data) {
      var responseObj = jQuery.parseJSON(data);
      var mediaType = responseObj.data; // Set media id in modal hidden value

      $('input[name=file-value]', $modal).val(responseObj.id);
      $('#file-manager-list').trigger('click');
    }
  });
  /*
  * When the user clicks on 'library' tab, load all images
  */

  $('#file-manager-list').on('click', function (e) {
    window.emitterHub.emit('FILE_MANAGER_LOAD_LIST');
    var fileValue = $('input[name=file-value]').val();
    $('.modal-footer', $modal).removeClass('visually-hidden'); // If user is in edit mode, set media as active and load sidebar

    if (fileValue != 0) {
      $('#file-manager-upload', $modal).removeClass('active');
      $('#file-manager-list', $modal).addClass('active');
      $('#tab-upload', $modal).removeClass('active show');
      $('#tab-images', $modal).addClass('active show');
      window.emitterHub.emit('FILE_MANAGER_UPDATE_SIDE_BAR', fileValue);
      window.emitterHub.emit('FILE_MANAGER_SELECT_ITEM', fileValue);
    }
  });
  /*
  * When the user clicks resets button, remove current active and reset hidden input value
  */

  $('.reset-image', $modal).on('click', function (e) {
    e.preventDefault(); // Remove all 'is-active' classes

    window.emitterHub.emit('FILE_MANAGER_RESET');
  });
  /*
  * When the user confirm an image from filemanager,
  * set image id as new value in admin form input and close the modal
  */

  $('.confirm-image', $modal).on('click', function (e) {
    e.preventDefault(); // Set admin form input value

    $('input[name=' + $('input[name=file-input]', $modal).val() + ']').val($('input[name=file-value]', $modal).val()); // Close modal

    $modal.modal('hide');
  });
  /*
   * When the user close the modal, reset sidebar and loader.
   */

  $('#filemanager').on('hidden.bs.modal', function () {
    $('#tab-upload', $modal).addClass('active show');
    $('#tab-images', $modal).removeClass('active show');
    $('#file-manager-upload', $modal).addClass('active');
    $('#file-manager-list', $modal).removeClass('active');
    window.emitterHub.emit('FILE_MANAGER_UPDATE_SIDE_BAR', null);
  });
});
/******/ })()
;