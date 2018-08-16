/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 59);
/******/ })
/************************************************************************/
/******/ ({

/***/ 11:
/***/ (function(module, exports) {

var SIZE_M = 768;
var SIZE_L = 992;
var SIZE_H = 1200;

var ANIMATION_TIMING = 300;

var Header = {
	query_m: window.matchMedia('(min-width: ' + SIZE_M + 'px)'),
	query_l: window.matchMedia('(min-width: ' + SIZE_L + 'px)'),
	query_h: window.matchMedia('(min-width: ' + SIZE_H + 'px)'),
	// navbar
	initNavbar: function initNavbar() {
		$('.nav-toggle').on('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var target = $(this).attr('href');
			if ($(target).hasClass('vertical')) {
				$(target).toggleClass('open');
				if (!Header.query_m.matches) {
					$('.nav').not(target).slideUp();
				}
			} else {
				if (!Header.query_m.matches) {
					$('.nav').not(target).removeClass('open');
					$(target).slideToggle(ANIMATION_TIMING);
				}
			}
		});
		$('.nav-sub-toggle').on('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			$(this).closest('li').siblings().find('.nav-sub').slideUp(ANIMATION_TIMING);
			$(this).siblings('.nav-sub').slideToggle(ANIMATION_TIMING);
		});
		$('html').on('click', function () {
			$('.nav-sub-toggle').siblings('.nav-sub').slideUp(ANIMATION_TIMING);
			if (!Header.query_m.matches) {
				$('.nav').each(function () {
					if ($(this).hasClass('vertical')) {
						if ($(this).hasClass('open')) {
							$(this).removeClass('open');
						}
					} else $(this).slideUp(ANIMATION_TIMING);
				});
			}
		});
		$(window).on('resize', function () {
			if (Header.query_m.matches) {
				$('.nav').css('display', '');
			}
		});
	}
};

$(function () {
	Header.initNavbar();
});

/***/ }),

/***/ 59:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(11);


/***/ })

/******/ });