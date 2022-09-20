<?php

namespace ProcessWire;

$class = 'InputfieldGooglePlaces';

?>
<div class='<?= $class ?>-container'>
	<input class='<?= $class ?>-input' <?= $attributes ?? '' ?> />
	<div class='<?= $class ?>-subheading'>Results for search query: <?= $query ?? '' ?></div>
	<div class='<?= $class ?>-list'>
		<?php foreach ($items as $key => $item) {
			$is_current = $item->place_id == $value;
			$photos = [];

			echo files()->render("{$this->config->paths->InputfieldGooglePlacesID}markup/list_item.php", [
				'class' => $class,
				'is_current' => $is_current,
				'photos' => $photos,
				'item' => $item,
				'field_id' => $field_id,
				'place_id' => $item->place_id,
				'heading' => $item->structured_formatting->main_text,
				'subheading' => $item->structured_formatting->secondary_text,
			]);
		} ?>
	</div>
</div>