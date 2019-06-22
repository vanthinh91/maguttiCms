// pb-repeater
// v 0.3

// ADD REPEATER
$('.repeater-add').each(function() {
	var elem = $(this);
	elem.click(function(e) {
		e.preventDefault();
		var target = elem.data('target');
		var clone = $(target).first().clone(true);
		$('.repeater-add').trigger('repeater:clone', [clone]);
		$(target).last().after(clone);
		$('.repeater-add').trigger('repeater:append', [clone]);
		add_repeater_events();
	});
});

// DELETE REPEATER
function add_repeater_events() {
	$('.repeater-delete').on('click', function() {
		var element = $(this).closest('.repeater');
		if( !element.is('.repeater:first')) {
			$( element ).remove();
		}
	});
}

add_repeater_events();

$('.repeater-add').on( 'repeater:clone', function(_e, clone) {
	clone.find('input[type="text"]').val('');
	clone.find('input[type="hidden"]').val('');
	clone.find('input[type="file"]').val('');
	clone.find('input[type="number"]').val(1);
	clone.find('textarea').val('');
	clone.find('input[type="checkbox"]').prop('checked', false);
	clone.find('.pbr-hide').hide();
	clone.find('.pbr-show').show();
	clone.find('.pbr-remove').remove();
});
