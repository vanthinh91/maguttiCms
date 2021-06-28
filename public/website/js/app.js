/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/website/app.js ***!
  \*************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

window.App = function () {
  function handleNewsletter() {
    $('#form-newsletter').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: urlAjaxHandler + "/api/newsletter",
        data: $("#form-newsletter").serialize(),
        dataType: 'json',
        success: function success(response) {
          var msgHtml = '';

          if (response.status == 'OK') {
            msgHtml += response.msg;
          } else {
            $.each(response.errors, function (_key, value) {
              msgHtml += '<h4>' + value[0] + '</h4>'; //showing only the first error.
            });
          }

          bootbox.alert({
            title: "Newsletter",
            message: msgHtml
          });
        },
        error: function error(_ref) {
          var responseJSON = _ref.responseJSON;
          var msgHtml = '';
          $.each(responseJSON.errors, function (_key, value) {
            msgHtml += '<h4>' + value[0] + '</h4>'; //showing only the first error.
          });
          bootbox.alert({
            title: "Newsletter",
            message: msgHtml
          });
        }
      });
    });
  }

  function handleLightBox() {
    $().fancybox({
      selector: '.lightbox'
    });
    $(".lightbox-iframe").fancybox({
      type: 'iframe',
      iframe: {
        css: {
          width: '800px'
        }
      }
    });
  }

  function handleScrollTo() {
    $(document).on('click', '.scroll-to', function (e) {
      e.preventDefault();
      App.scrollTo($(this).attr('href'));
    });

    if (window.location.hash) {
      App.scrollTo(window.location.hash);
    }
  }

  function initOverrideInvalid() {
    var offset = $('.navbar.fixed-top').outerHeight() + 30;
    document.addEventListener('invalid', function (e) {
      var elem = $(e.target);
      elem.addClass('override-invalid');

      if ($('.override-invalid:visible').length) {
        $('html, body').animate({
          scrollTop: $('.override-invalid:visible').first().offset().top - offset
        }, 0);
      }
    }, true);
    document.addEventListener('change', function (e) {
      $(e.target).removeClass('override-invalid');
    }, true);
  }

  return {
    init: function init() {
      handleNewsletter();
      handleLightBox();
      handleScrollTo(); //initOverrideInvalid();
    },
    scrollTo: function scrollTo(hash) {
      var margin_top = $("nav").outerHeight();
      var elem_top = $(hash).offset().top;
      $('html, body').stop().animate({
        'scrollTop': elem_top - margin_top
      }, 500);
    },
    formValidation: function formValidation(selector) {
      $('#' + selector).submit(function (event) {
        event.preventDefault();
        $.ajax({
          type: 'POST',
          url: urlAjaxHandler + '/api/' + selector,
          data: $('#' + selector).serialize(),
          dataType: 'json',
          success: function success(response) {
            if (response.status == 'ok') {
              $('#' + selector).hide();
              $('#response').show().text(response.msg);
            } else {
              $.each(response.errors, function (key, _value) {
                $('[name="' + key + '"]').addClass('error');
              });
              $('html, body').animate({
                scrollTop: $('#' + selector).offset().top - $('nav').height()
              }, 1200, 'swing');
            }
          }
        });
      });
    }
  };
}();
/******************************** MODAL ************************/


function updateModalAlertMsg($htmlContent) {
  bootbox.alert($htmlContent, function () {});
}

function updateModalBoxMsg($htmlContent) {
  bootbox.confirm($htmlContent, function () {});
}
/*********************************  localize *********************/


window.trans = function (keystring) {
  var key_array = keystring.split('.');
  var temp_localization = JS_LOCALIZATION;

  var _iterator = _createForOfIteratorHelper(key_array),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var key = _step.value;

      if (key in temp_localization) {
        temp_localization = temp_localization[key];
      }
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }

  if (typeof temp_localization == 'string') {
    return temp_localization;
  } else {
    return keystring;
  }
};

var Toast = Swal.mixin({
  toast: true,
  position: 'top-right',
  iconColor: 'green',
  customClass: {
    popup: 'colored-toast'
  },
  showConfirmButton: false,
  timer: 1500,
  timerProgressBar: true
});

window.sendOrderNotification = function (order_token) {
  var api_url = "".concat(window.urlAjaxHandler, "/api/store/resend-order-notification/").concat(order_token);
  axios.get(api_url).then(function (_ref2) {
    var data = _ref2.data;
    Toast.fire({
      icon: data.msg.type,
      title: data.msg.text
    });
  }, function (error) {
    console.log(error);
  });
};
/******/ })()
;