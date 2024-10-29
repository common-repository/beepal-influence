<?php settings_errors(); ?>
<form method="post" action="options.php">
	<?php settings_fields( 'beepal-settings-group' ); ?>
	<?php do_settings_sections( 'beepal' ); ?>
	<?php submit_button(); ?>
</form>