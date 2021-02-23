/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/website/app.js":
/*!*************************************!*\
  !*** ./resources/js/website/app.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

window.App = function () {
  function handleBootstrap() {
    /*Bootstrap Carousel*/
    $('.carousel').carousel({
      interval: 5000,
      pause: 'hover'
    });
    /*Tooltips*/

    $('.tooltips').tooltip();
    $('.tooltips-show').tooltip('show');
    $('.tooltips-hide').tooltip('hide');
    $('.tooltips-toggle').tooltip('toggle');
    $('.tooltips-destroy').tooltip('destroy');
    /*Popovers*/

    $('.popovers').popover();
    $('.popovers-show').popover('show');
    $('.popovers-hide').popover('hide');
    $('.popovers-toggle').popover('toggle');
    $('.popovers-destroy').popover('destroy');
  }

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
            msgHtml += '<h4>' + response.msg + '</h4>';
          } else {
            $.each(response.errors, function (_key, value) {
              msgHtml += '<h4>' + value[0] + '</h4>'; //showing only the first error.
            });
          }

          updateModalAlertMsg(msgHtml);
        },
        error: function error(_ref) {
          var responseJSON = _ref.responseJSON;
          var msgHtml = '';
          $.each(responseJSON.errors, function (_key, value) {
            msgHtml += '<h4>' + value[0] + '</h4>'; //showing only the first error.
          });
          updateModalAlertMsg(msgHtml);
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

  function handleGhostInputs() {
    $('.form-ghost').each(function () {
      var elem = $(this);
      elem.data('original', elem.val());
    }).blur(function (e) {
      e.preventDefault();
      var elem = $(this);

      if (elem.val() != elem.data('original')) {
        var id = elem.data('id');
        var model = elem.data('model');
        var field = elem.data('field');
        var value = elem.val();
        $.ajax({
          type: 'POST',
          url: '/api/	update-ghost',
          data: {
            id: id,
            model: model,
            field: field,
            value: value,
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          dataType: 'json',
          success: function success(response) {
            elem.data('original', value);
            $.each(response.alerts, function () {
              $.smkAlert({
                text: this.text,
                type: this.type,
                time: this.time
              });
            });
          },
          error: function error() {
            $.smkAlert({
              text: trans('website.ghost.error'),
              type: 'danger',
              time: 5
            });
          }
        });
        return true;
      }
    });
  }

  function handleNavbar() {
    // deprecato

    /*
    let WINDOW = $(window);
    WINDOW.on('scroll', function () {
    	checkNavbar();
    });
    checkNavbar();
    */
    $.pbScrollTriger({
      selector: 'nav',
      "class": 'navbar-scrolled',
      use_element_position: false,
      apply_class_to_body: false
    });
  }

  window.myFunc = function (val) {
    return alert(val);
  };

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
      handleBootstrap();
      handleNewsletter();
      handleLightBox();
      handleScrollTo();
      handleGhostInputs();
      handleNavbar();
      initOverrideInvalid();
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

window.modalPino = function ($htmlContent) {
  bootbox.alert($htmlContent, function () {});
};
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

/***/ }),

/***/ "./resources/sass/admin/app.scss":
/*!***************************************!*\
  !*** ./resources/sass/admin/app.scss ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/website/app.scss":
/*!*****************************************!*\
  !*** ./resources/sass/website/app.scss ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************************************************************!*\
  !*** multi ./resources/js/website/app.js ./resources/sass/website/app.scss ./resources/sass/admin/app.scss ***!
  \*************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/marcoasperti/web/magutti/maguttiCms/resources/js/website/app.js */"./resources/js/website/app.js");
__webpack_require__(/*! /Users/marcoasperti/web/magutti/maguttiCms/resources/sass/website/app.scss */"./resources/sass/website/app.scss");
module.exports = __webpack_require__(/*! /Users/marcoasperti/web/magutti/maguttiCms/resources/sass/admin/app.scss */"./resources/sass/admin/app.scss");


/***/ })

/******/ });