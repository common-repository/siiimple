<?php
require_once( dirname( III_PLUGIN_FILE ) . '/includes/functions/front-office.php' );
require_once( dirname( III_PLUGIN_FILE ) . '/includes/functions/shortcodes.php' );
if ( is_admin() ) :
	require_once( dirname( III_PLUGIN_FILE ) . '/includes/functions/back-office.php' );
	require_once( dirname( III_PLUGIN_FILE ) . '/includes/functions/options.php' );
endif;