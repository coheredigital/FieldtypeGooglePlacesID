<?php

namespace ProcessWire;

$filename = sanitizer()->pageName($heading, true);

?>
<div class='<?= $class ?>-list_item <?= $is_current ? 'current' : '' ?>' id='place_item_<?= $place_id ?>'>
	<div class='<?= $class ?>-list_item_inner'>
		<div class='<?= $class ?>-list_item_description'>
			<div class='<?= $class ?>-list_item_heading'><?= $heading ?? '' ?></div>
			<div class='<?= $class ?>-list_item_subheading'><?= $subheading ?? '' ?></div>
		</div>
		<div class='<?= $class ?>-list_item_buttons'>
			<a target='_blank' href='https://www.google.com/maps/search/?api=1&query=Google&query_place_id=<?= $item->place_id ?>' class='<?= $class ?>-list_item_tag <?= $class ?>-list_item_link'>View on Google Maps</a>
			<div onclick='InputfieldGooglePlaceID("#<?= $field_id ?>", "<?= $place_id ?>")' class='<?= $class ?>-list_item_tag <?= $class ?>-list_item_selected'>Selected</div>
			<div onclick='InputfieldGooglePlaceID("#<?= $field_id ?>", "<?= $place_id ?>")' class='<?= $class ?>-list_item_tag <?= $class ?>-list_item_select'>Select</div>
		</div>
	</div>

</div>