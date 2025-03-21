<div class="wrap">
	<h1>Дополнительная страница опций темы</h1>
	<form action="options.php" method="post">

		<?php settings_fields('webuild_general_group'); ?>

		<?php do_settings_sections('webuild-options-subpage'); ?>

		<?php submit_button(); ?>

	</form>
</div>