function InputfieldGooglePlaceID(id,value) {
	var $input = $(id);
	var $this = $('#place_item_' + value);
	var $list = $input.siblings('.InputfieldGooglePlaces-list');
	var $list_items = $list.children('.InputfieldGooglePlaces-list_item');

	var current_value = $input.val();
	var is_changed = current_value != value;

	$list_items.removeClass('current');

	$input.val(is_changed ? value : '');
	if (is_changed){
		$this.addClass('current');
	}
}