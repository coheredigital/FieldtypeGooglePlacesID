<?php

namespace ProcessWire;

if (!count($photos)) {
	return;
}
?>
<div class='<?= $class ?>-list_item_images'>
	<div class='<?= $class ?>-list_item_images_list'>
		<?php foreach ($photos as $photo) :
			$filename = $filename . '-' . \md5($photo->uid);
		?>
			<a target="_blank" download="<?= $filename ?>.jpg" href="<?= $photo['urls']['large'] ?>">
				<img width=80 height=80 src='<?= $photo['urls']['small'] ?>'>
			</a>
		<?php endforeach; ?>
	</div>
	<div class='<?= $class ?>-note'>Available Images</div>
</div>