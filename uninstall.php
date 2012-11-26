<?php
/** uninstall.php
 *
 * Deletes all traces of this plugin
 */


// Don't uninstall unless you absolutely want to!
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	wp_die( 'WP_UNINSTALL_PLUGIN undefined.' );
}


// Delete the data
delete_option( 'jtv-jetpack-twitter-via' );


/* Goodbye! Thank you for having me! */


/* End of file uninstall.php */
/* Location: ./wp-content/plugins/jetpack-twitter-via/uninstall.php */