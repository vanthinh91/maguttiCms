window.App = function () {
	function handleNewsletter() {
		$('#form-newsletter').on('submit', function (e) {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: urlAjaxHandler + "/api/newsletter",
				data: $("#form-newsletter").serialize(),
				dataType: 'json',
				success: function (response) {
					let msgHtml = '';
					if (response.status == 'OK') {
						msgHtml +=response.msg;
					} else {
						$.each(response.errors, function (_key, value) {
							msgHtml += '<h4>' + value[0] + '</h4>'; //showing only the first error.
						});
					}
					bootbox.alert({
						title: "Newsletter",
						message: msgHtml,
					})

				},
				error: function ({responseJSON}) {
					let msgHtml = '';
					$.each(responseJSON.errors, function (_key, value) {
						msgHtml += '<h4>' + value[0] + '</h4>'; //showing only the first error.
					});
					bootbox.alert({
						title: "Newsletter",
						message: msgHtml
					})
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
					width: '800px',
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
			let elem = $(e.target);
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
		init: function () {
			handleNewsletter();
			handleLightBox();
			handleScrollTo();
		   //initOverrideInvalid();
		},

		scrollTo: function (hash) {
			var margin_top = $("nav").outerHeight();
			var elem_top = $(hash).offset().top;
			$('html, body').stop().animate({
				'scrollTop': elem_top - margin_top
			}, 500);
		},

		formValidation: function (selector) {
			$('#' + selector).submit(function (event) {
				event.preventDefault();

				$.ajax({
					type: 'POST',
					url: urlAjaxHandler + '/api/' + selector,
					data: $('#' + selector).serialize(),
					dataType: 'json',
					success: function (response) {
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
	let key_array = keystring.split('.');
	let temp_localization = JS_LOCALIZATION;
	for (let key of key_array) {
		if (key in temp_localization) {
			temp_localization = temp_localization[key];
		}
	}
	if (typeof temp_localization == 'string') {
		return temp_localization;
	} else {
		return keystring;
	}
}
const Toast = Swal.mixin({
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

window.sendOrderNotification = function (order_token){
    let api_url=`${window.urlAjaxHandler}/api/store/resend-order-notification/${order_token}`;

	axios.get(api_url)
	  .then(({data}) => {
		  Toast.fire({
			  icon: data.msg.type,
			  title: data.msg.text,
		  })
	   }, (error) => {
			console.log(error);
	  });
}