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
		$('#form-newsletter').on('submit', function(e) {
			e.preventDefault();
			$.ajax({
				type : 'POST',
				url : urlAjaxHandler+"/api/newsletter",
				data : $( "#form-newsletter" ).serialize(),
				dataType : 'json',
				success : function(response) {
					var msgHtml = '';
					if (response.status=='ok') {
						msgHtml += '<h4>' + response.msg + '</h4>';
					}
					else {
						$.each( response.errors , function( _key, value ) {
							msgHtml += '<h4>' + value[0] + '</h4>'; //showing only the first error.
						});
					}
					updateModalAlertMsg(msgHtml);
				},
				error : function() {
					updateModalAlertMsg('Error');
				}
			});
		});
	}

	// checkboxes and radio
	function initCheckboxes() {
		$(document).on('change', 'input[type="checkbox"], input[type="radio"]', function() {
			let elem = $(this);
			if (elem.is('input[type="radio"]')) {
				$('input[type="radio"][name="' + elem.attr('name') + '"]').each(function() {
					updateCheckbox($(this));
				});
			} else
			updateCheckbox($(this));
		}).each(function() {
			updateCheckbox($(this));
		});
	}

	function updateCheckbox(elem) {
		let checked = elem.is(':checked');
		if (checked)
			elem.closest('.form-checkbox, .form-radio').addClass('checked');
		else
			elem.closest('.form-checkbox, .form-radio').removeClass('checked');
	}

	function handleLightBox() {
		$(".lightbox").fancybox();
	}

	function handleWow() {
		window.wow.init({
			mobile:	false,	// default
			live:	false	// default
		});
	}

	function handleScrollTo() {
		$(document).on('click', '.scroll-to', function(e) {
			e.preventDefault();
			App.scrollTo($(this).attr('href'));
		});
		if (window.location.hash) {
			App.scrollTo(window.location.hash);
		}
	}

	function handleGhostInputs() {
		$('.form-ghost').each(function() {
			let elem = $(this);
			elem.data('original', elem.val());
		}).blur(function(e) {
			e.preventDefault();

			let elem = $(this);

			if (elem.val() != elem.data('original')) {
				let id  = elem.data('id');
				let model  = elem.data('model');
				let field  = elem.data('field');
				let value  = elem.val();

				$.ajax({
					type : 'POST',
					url : '/api/update-ghost',
					data : {
						id : id,
						model: model,
						field: field,
						value: value,
						_token: Laravel.csrfToken
					},
					dataType : 'json',
					success : function(response) {
						elem.data('original', value);
						$.each(response.alerts, function() {
							$.smkAlert({
								text: this.text,
								type: this.type,
								time: this.time
							});
						});
					},
					error : function() {
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
		let WINDOW = $(window);
		WINDOW.on('scroll', function() {
			checkNavbar();
		});
		checkNavbar();
	}

	function checkNavbar() {
		let WINDOW = $(window);
		let BODY = $('body').first();
		let NAV = $('nav.navbar').first();
		if (WINDOW.scrollTop() > 100) {
			BODY.addClass('navbar-scrolled');
			NAV.addClass('navbar-scrolled');
		} else {
			BODY.removeClass('navbar-scrolled');
			NAV.removeClass('navbar-scrolled');
		}
	}

	function initOverrideInvalid() {
        var offset = $('.navbar-fixed-top').outerHeight() + 30;

        document.addEventListener('invalid', function(e) {
            $(e.target).addClass('invalid');
            $('html, body').animate({
                scrollTop: $($(".invalid")[0]).offset().top - offset
            }, 0);
        }, true);
        document.addEventListener('change', function(e) {
            $(e.target).removeClass('invalid');
        }, true);
    }

	return {
		init: function () {
			handleBootstrap();
			handleNewsletter();
			handleLightBox();
			handleWow();
			handleScrollTo();
			handleGhostInputs();
			handleNavbar();
			initCheckboxes();
			initOverrideInvalid();
		},

		scrollTo: function(hash) {
			var margin_top = $("nav").outerHeight();
			var elem_top = $(hash).offset().top;
			$('html, body').stop().animate({'scrollTop': elem_top - margin_top}, 500);
		},

		formValidation: function(selector) {
			$('#'+selector).submit(function (event) {
				event.preventDefault();

				$.ajax({
					type: 'POST',
					url: urlAjaxHandler + '/api/' + selector,
					data: $('#'+selector).serialize(),
					dataType: 'json',
					success: function (response) {
						if (response.status == 'ok') {
							$('#'+selector).hide();
							$('#response').show().text(response.msg);
						} else {
							$.each(response.errors, function (key, _value) {
								$('[name="' + key + '"]').addClass('error');
							});

							$('html, body').animate({
								scrollTop: $('#'+selector).offset().top - $('nav').height()
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
	bootbox.alert($htmlContent, function() {});
}

function updateModalBoxMsg($htmlContent) {
	bootbox.confirm($htmlContent, function() {});
}

/*********************************  localize *********************/
function trans(keystring) {
	var key_array = keystring.split('.');
	var temp_localization = JS_LOCALIZATION;
	$.each(key_array, function() {
		temp_localization = temp_localization[this];
	});
	if (typeof(temp_localization) == 'string')
	return temp_localization;
	else
	return keystring;
}
