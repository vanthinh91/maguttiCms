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
/******/ 	return __webpack_require__(__webpack_require__.s = 61);
/******/ })
/************************************************************************/
/******/ ({

/***/ 13:
/***/ (function(module, exports) {

var CART_COUNT = '.cart-count';
var CART_TOTAL = '.cart-total';
var CART_PREVIEW = '.cart-preview'; //triggers preview calculations
var CART_BUTTONS = '#cart-buttons';

var ITEM_BLOCK = '.cart-item-block';
var ITEM_ADD = '.cart-item-add';
var ITEM_REMOVE = '.cart-item-remove';
var ITEM_QUANTITY = '.cart-item-quantity';
var ITEM_TOTAL = '.cart-item-total';

var ORDER_PREVIEW = '.order-preview'; //triggers preview calculations
var ORDER_PRODUCTS = '.order-products-cost';
var ORDER_SHIPPING = '.order-shipping-cost';
var ORDER_VAT = '.order-vat-cost';
var ORDER_TOTAL = '.order-total-cost';

window.Store = function () {
	function formatPrice(price) {
		var parts = price.toFixed(StoreConfig.decimals).split(".");
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, StoreConfig.thousands_separator);
		formatted_price = parts.join(StoreConfig.decimal_separator);

		if (StoreConfig.prepend_currency) {
			formatted_price = StoreConfig.currency_symbol + ' ' + formatted_price;
		}
		if (StoreConfig.append_currency) {
			formatted_price += ' ' + config('maguttiCms.store.currency_symbol');
		}

		return formatted_price;
	}

	function handleCartItemQuantity() {
		$(document).on('change', ITEM_QUANTITY, function () {
			var elem = $(this);
			$(ITEM_ADD).data('quantity', Math.max(elem.val(), 1));
		});
	}

	function handleCartItemAdd() {
		$(document).on('click', ITEM_ADD, function (e) {
			e.preventDefault();
			var elem = $(this);

			var product_code = elem.data('product-code');
			var product_model_code = elem.data('product-model-code');
			var quantity = elem.data('quantity');

			$.ajax({
				type: 'POST',
				url: '/api/store/cart-item-add',
				data: {
					product_code: product_code,
					product_model_code: product_model_code,
					quantity: quantity,
					_token: Laravel.csrfToken
				},
				dataType: 'json',
				success: function success(response) {
					$(CART_COUNT).text(response.cart_count);
					$.each(response.alerts, function () {
						$.smkAlert({
							text: this.text,
							type: this.type,
							time: this.time
						});
					});
				},
				error: function error(response) {
					$.smkAlert({
						text: 'Error',
						type: 'danger',
						time: 5
					});
				}
			});
		});
	}

	function handleCartItemRemove() {
		$(document).on('click', ITEM_REMOVE, function (e) {
			e.preventDefault();
			var elem = $(this);

			var id = elem.data('id');

			$.ajax({
				type: 'POST',
				url: '/api/store/cart-item-remove',
				data: {
					cart_item_id: id,
					_token: Laravel.csrfToken
				},
				dataType: 'json',
				success: function success(response) {
					$(CART_COUNT).text(response.cart_count);
					elem.closest(ITEM_BLOCK).remove();
					calcCartPreview();
					if (!$(ITEM_BLOCK).length) $(CART_BUTTONS).remove();
					$.each(response.alerts, function () {
						$.smkAlert({
							text: this.text,
							type: this.type,
							time: this.time
						});
					});
				},
				error: function error(response) {
					$.smkAlert({
						text: 'Error',
						type: 'danger',
						time: 5
					});
				}
			});
		});
	}

	function calcCartPreview() {
		var total = 0;
		$(ITEM_BLOCK).each(function () {
			var elem = $(this);
			var price = elem.data('price');
			var quantity = elem.find(ITEM_QUANTITY).first().val();
			var partial = price * quantity;
			elem.find(ITEM_TOTAL).first().text(formatPrice(partial));
			total += partial;
		});
		$(CART_TOTAL).text(formatPrice(total));
	}

	function handleCartPreview() {
		$(CART_PREVIEW).change(function () {
			calcCartPreview();
		});
	}

	function calcOrderPreview() {
		var cart = $('#order-cart').val();
		var billing = $('#order-billing-address').val();
		var shipping = $('#order-shipping-address').val();

		$.ajax({
			type: 'POST',
			url: '/api/store/order-calc',
			data: {
				cart: cart,
				address: shipping || billing,
				_token: Laravel.csrfToken
			},
			dataType: 'json',
			success: function success(response) {
				$(ORDER_PRODUCTS).text(formatPrice(response.products));
				$(ORDER_SHIPPING).text(formatPrice(response.shipping));
				$(ORDER_VAT).text(formatPrice(response.vat));
				$(ORDER_TOTAL).text(formatPrice(response.total));
			},
			error: function error(response) {}
		});
	}

	function handleOrderPreview() {
		$(ORDER_PREVIEW).change(function () {
			calcOrderPreview();
		});
		if ($(ORDER_PREVIEW).length) calcOrderPreview();
	}

	return {
		init: function init() {
			handleCartItemQuantity();
			handleCartItemAdd();
			handleCartItemRemove();
			handleCartPreview();
			handleOrderPreview();
		}
	};
}();

/***/ }),

/***/ 61:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(13);


/***/ })

/******/ });