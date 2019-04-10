/***************************************************/
/* PB Scroll Trigger                               */
/* Version: 1.0                                    */
/* Author: Paolo Bonacina                          */
/***************************************************/

/*
reads from input elements and displays a dropdown with suggestions
clicking the dropdown copies the selected row to the input with optional form submit

Typical usage:

$(#input).pbsSuggest({key: value, key: value, key: value, ... });

Available parameters:
	selector			REQUIRED STRING
	call:				REQUIRED STRING		Api to call. It must return an object of key-value pairs. The key will be copied to the input when the user selects a suggestion. The value is the text displayed to the user.
	token:				STRING				Cross-site-request-forgery token sent to the api.
	count:				INTEGER				Max number of results to display.
	min_chars:			INTEGER				Minimum number of characters needed to show suggestions.
	submit:				BOOL				Wether to automatically submit the form the input is in when the user selects a suggestion.
	filters:			ARRAY				Key-value pairs sent to the api to dynamically change your api call.
	target:				STRING				A jQuery selector to an input that will accept the result in place of the input the user is tiping into.
	target_container:	STRING				A jQuery selector to an HTML element containing both the input and the target (useful for repeating elements).
	append:				BOOL				Wether to append the result to the target instead of replacing it.
	append_separator:	STRING				String to prepend to the result before appending it to the target.
	navigate_on_select:	BOOL				Wether to navigate to the link instead of copying its content to the input (useful for product search).
	text_start:			STRING				Text displayed when clicking inside the input before typing.
	text_search:		STRING				Text displayed while searching results.
	text_no_results:	STRING				Text displayed when the api did not return any item.
	animation_time:		INTEGER				Animation duration in milliseconds. Set to 0 to disable animation.
});

The plugin makes a GET call and sends automatically the following parameters:
	search_text:		STRING				The user input,
	count:				INTEGER				Max number of results to display,
	filters:			ARRAY				Key-value pairs to dynamically change your api call
	_token:				STRING				For laravel applications

In the request header, the plugin also sends a parameter named "X-Call-Id". You should return this parameter as-is in the response headers if you want to prevent old but slow responses to override newer an quicker ones.

The plugin expects the call to return results in this format:
	{
		result1key: result1value,
		result2key: result2value,
		result3key: result3value
	}
*/


/*	constants	*/
// core variables
var DEFAULT_COUNT = 5;							// Max number of results to display.
var DEFAULT_MIN_CHARS = 5;						// Minimum number of characters needed to show suggestions.
var DEFAULT_SUBMIT = false;						// Wether to automatically submit the form the input is in when the user selects a suggestion.
var DEFAULT_FILTERS = [];						// Key-value pairs sent to the api to dynamically change your api call.
var DEFAULT_APPEND = false;						// Wether to append the result to the target instead of replacing it.
var DEFAULT_APPEND_SEPARATOR = ' ';				// String to prepend to the result before appending it to the target.

var DEFAULT_ANIMATION_TIME = 100;						// Duration of slide animations

var default_config = {
	count:				DEFAULT_COUNT,
	min_chars:			DEFAULT_MIN_CHARS,
	submit:				DEFAULT_SUBMIT,
	filters:			DEFAULT_FILTERS,
	append:				DEFAULT_APPEND,
	append_separator:	DEFAULT_APPEND_SEPARATOR,
	text_start:			DEFAULT_TEXT_START,
	text_search:		DEFAULT_TEXT_SEARCH,
	text_no_results:	DEFAULT_TEXT_NO_RESULTS,
	animation_time:		DEFAULT_ANIMATION_TIME
};

/*	variables	*/
var result_count;								// number of entries found

// returns a config value, or its default
function pbstConfigDefault(var_value, default_value) {
	return (var_value)? var_value : default_value;
}

// used to print errors in console
function pbstError(content, check) {
	check = check || false;
	if (!check) {
		console.error('PB Scroll Trigger - ERROR:');
		console.error(content);
	}
}

// reads a configuration object and fires errors for required parameters
function pbstReadConfig(config_object) {
	var config = $.extend(default_config, config_object);

	pbstError('Missing API address.', config.call);

	return config;
}

function pbstSetTimout(time) {
	WINDOW.on('scroll', function() {
		checkNavbar();
	});
}

// functionality initialization
(function($) {
	$.pbScrollTriger = function(config_object) {
		let config = pbstReadConfig(config_object);
		let WINDOW = $(window);
		checkNavbar();
    };
} (jQuery));


function checkNavbar() {
	let WINDOW = $(window);
	let BODY = $('body').first();
	let NAV = $('nav.navbar').first();
	if (WINDOW.scrollTop() > 100) {
		BODY.addClass('scrolled');
		NAV.addClass('scrolled');
	}
	else {
		BODY.removeClass('scrolled');
		NAV.removeClass('scrolled');
	}
}
handleNavbar();
